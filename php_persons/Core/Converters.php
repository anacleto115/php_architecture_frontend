<?php 
    namespace php_persons\Core
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_language/Bundle.php';
    
        use lib_language\Bundle as Bundle;

        class ConverterBool
        {
            public static function Convert($value): string
            {
                try
                {
                    if ($value == "true" || $value == "True" || $value == "1")
                        return Bundle::Get("RsMessages", "lbActive");
                    return Bundle::Get("RsMessages", "lbInactive");
                }
                catch (Exception $ex)
                {
                    return Bundle::Get("RsMessages", "lbInactive");
                }
            }
        }

        class ConverterDate
        {
            public static function Convert($value, $format = ""): string
            {
                try
                {
                    if ($value == null || $value == "")
                        return "";
                    if ($format == "input")
                        return $value->format('Y-m-d\TH:i');
                    return $value->format('d/m/Y H:i:s');
                }
                catch (Exception $ex)
                {
                    return "";
                }
            }
        }
        
    }
?>