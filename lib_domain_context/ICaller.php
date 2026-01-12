<?php
    namespace lib_domain_context
    {
        interface ICaller
        {
            function Execute(array $data): array;
        }
    
        class FactoryCaller 
        {
            public static ?IFactory $IFactoryCaller = null;
    
            public static function Get(array $data): ?ICaller
            {
                if (FactoryCaller::$IFactoryCaller == null)
                    return null;
    
                return FactoryCaller::$IFactoryCaller->Get($data);
            }
        }
    }
?>