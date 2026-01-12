<?php
    namespace lib_presentation_context\Core
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_language/Bundle.php';

        use lib_language\Bundle as Bundle;

        class ErrorHelper
        {
            public static function GetMessage(string $key): string
            {
                $response = Bundle::Get("RsMessages", $key);
                if ($response == null ||
                    $response == "")
                    return Bundle::Get("RsMessages", "lbTryAgain");
                return $response;
            }
        }
    }
?>