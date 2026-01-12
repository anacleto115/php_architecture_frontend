<?php
    namespace lib_communication_context\Core
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/ICommunication.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IFactory.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/Enumerables.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_communication_context/Implementations/PersonTypesCommunication.php';

        use lib_domain_context\ICommunication as ICommunication;
        use lib_domain_context\IFactory as IFactory;
        use lib_domain_context\Types as Types;
        use lib_communication_context\Implementations\PersonTypesCommunication as PersonTypesCommunication;

        class FactoryCommunicationContext implements IFactory
        {
            public function Get(array $data): object
            {
                $type = $data["Type"];
                switch ($type)
                {
                    case Types::PersonTypes: return new PersonTypesCommunication($data);
                    default: return null;
                }
            }
        }
    }
?>