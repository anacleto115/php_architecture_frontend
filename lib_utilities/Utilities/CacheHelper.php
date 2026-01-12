<?php
    namespace lib_utilities\Utilities
    {
        interface ICacheHelper
        {
            function Add(string $key, object $value): void;
            function Instance(): void;
            function Contains(string $key): bool;
            function Get(string $key): ?object;
            function Remove(string $key): void;
        }

        class CacheDictionary implements ICacheHelper
        {
            private ?array $data = null;

            public function Add(string $key, object $value): void
            {
                $this->Instance();
                $this->data[$key] = $value;
            }

            public function Contains(string $key): bool
            {
                $this->Instance();
                return array_key_exists($key, $this->data);
            }

            public function Get(string $key): ?object
            {
                $this->Instance();
                if (!$this->Contains($key))
                    return null;
                return $this->data[$key];
            }

            public function Instance(): void
            {
                if ($this->data != null)
                    return;
                $this->data = array();
            }

            public function Remove(string $key): void
            {
                $this->Instance();
                if (!$this->Contains($key))
                    return;
                unset($this->data[$key]);
            }
        }

        class CacheHelper
        {
            private static ?ICacheHelper $ICacheHelper = null;

            public static function Add(string $key, object $value): void
            {
                CacheHelper::CreateInstance();
                CacheHelper::$ICacheHelper->Add($key, $value);
            }

            public static function CreateInstance(ICacheHelper $iCacheHelper = null): void
            {
                if (CacheHelper::$ICacheHelper != null)
                    return;
                if ($iCacheHelper != null)
                    CacheHelper::$ICacheHelper = $iCacheHelper;
                else if (CacheHelper::$ICacheHelper == null)
                    CacheHelper::$ICacheHelper = new CacheDictionary();
            }

            public static function Contains(string $key): bool
            {
                CacheHelper::CreateInstance();
                return CacheHelper::$ICacheHelper->Contains($key);
            }

            public static function Get(string $key): ?object
            {
                CacheHelper::CreateInstance();
                return CacheHelper::$ICacheHelper->Get($key);
            }

            public static function Remove(string $key): void
            {
                CacheHelper::CreateInstance();
                CacheHelper::$ICacheHelper.Remove($key);
            }
        }
    }
?>