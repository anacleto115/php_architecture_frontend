<?php
    namespace lib_utilities\Utilities
    {
        class JsonHelper
        {
            public static function ConvertToObject(string $data, int $repeat = 0): array
            {
                $response = json_decode($data, true);
                for ($count = 0; $count < $repeat; $count++)
                    $response = json_decode($response, true);
                return $response;
            }

            public static function ConvertToString(array $data): string
            {
                return json_encode($data);
            }
        }
    }
?>