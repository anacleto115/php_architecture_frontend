<?php
    namespace lib_communication_context\Core
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/ICaller.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IFactory.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_communication_context/Core/CallerServices.php';

        use lib_domain_context\ICaller as ICaller;
        use lib_domain_context\IFactory as IFactory;
        use lib_communication_context\Core\CallerServices as CallerServices;

        class FactoryCallerContext implements IFactory
        {
            public function Get(array $data): object
            {
                return new CallerServices();
            }
        }
    }
?>