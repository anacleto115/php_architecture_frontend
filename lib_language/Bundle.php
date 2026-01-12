<?php
    namespace lib_language
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_language/RsMenu.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_language/RsMessages.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_language/Applications/RsLogin.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_language/Applications/RsPersons.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_language/Maintenances/RsHome.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_language/Maintenances/RsPersonTypes.php';

        use lib_language\RsMenu as RsMenu;
        use lib_language\RsMessages as RsMessages;
        use lib_language\Applications\RsLogin as RsLogin;
        use lib_language\Applications\RsPersons as RsPersons;
        use lib_language\Maintenances\RsHome as RsHome;
        use lib_language\Maintenances\RsPersonTypes as RsPersonTypes;
        
        class Bundle
        {
            private static $data = null;

            public static function Load(string $language): void
            {
                Bundle::$data = Bundle::$data == null ? array() : Bundle::$data;
                Bundle::$data["RsMenu"] = (new RsMenu($language))->Get();
                Bundle::$data["RsMessages"] = (new RsMessages($language))->Get();
                Bundle::$data["RsHome"] = (new RsHome($language))->Get();
                Bundle::$data["RsPersonTypes"] = (new RsPersonTypes($language))->Get();
                Bundle::$data["RsLogin"] = (new RsLogin($language))->Get();
                Bundle::$data["RsPersons"] = (new RsPersons($language))->Get();
            }

            public static function Get(string $resource, string $key): string
            {
                $response = "";
                if (!array_key_exists($resource, Bundle::$data))
                    return $response;
                $resources = Bundle::$data[$resource];
                if (!array_key_exists($key, $resources))
                    return $response;
                return $resources[$key];
            }
        }
    }
?>