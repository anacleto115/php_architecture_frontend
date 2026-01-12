<?php
    namespace lib_communication_core\Interfaces
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/ICommunication.php';

        use lib_domain_context\ICommunication as ICommunication;
        
        interface IPersonTypesCommunication extends ICommunication { }
    }
?>