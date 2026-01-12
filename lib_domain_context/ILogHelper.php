<?php
    namespace lib_domain_context
    {
        interface ILogHelper
        {
            function Log(Exception $exception): void;
        }
    
        class LogHelper
        {
            private static ?ILogHelper $ILogHelper;

            public static function Set(?ILogHelper $iLogHelper): void
            {
                ILogHelper::$ILogHelper = $iLogHelper;
            }

            public static function Log(Exception $exception): void
            {
                if (ILogHelper::$ILogHelper == null)
                    return;
                ILogHelper::$ILogHelper->Log($exception);
            }
        }
    }
?>