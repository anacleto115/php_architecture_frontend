<?php
    namespace lib_presentation_core\Core
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IHelper.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IFactory.php';

        use lib_domain_context\IHelper as IHelper;
        use lib_domain_context\IFactory as IFactory;

        class FactoryHelper 
        {
            public static ?IFactory $IFactoryHelper = null;
    
            public static function Get(array $data): ?IHelper
            {
                if (FactoryHelper::$IFactoryHelper == null)
                    return null;
    
                return FactoryHelper::$IFactoryHelper->Get($data);
            }
        }
    }
?>