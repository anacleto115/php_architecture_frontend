<?php
    namespace lib_communication_core\Core
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/ICommunication.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IFactory.php';

        use lib_domain_context\ICommunication as ICommunication;
        use lib_domain_context\IFactory as IFactory;

        class FactoryCommunication 
        {
            public static ?IFactory $IFactoryCommunication = null;
    
            public static function Get(array $data): ?ICommunication
            {
                if (FactoryCommunication::$IFactoryCommunication == null)
                    return null;
    
                return FactoryCommunication::$IFactoryCommunication->Get($data);
            }
        }
    }
?>