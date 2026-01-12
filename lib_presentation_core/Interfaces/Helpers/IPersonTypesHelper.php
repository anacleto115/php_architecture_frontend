<?php
    namespace lib_presentation_core\Interfaces\Helpers
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IHelper.php';

        use lib_domain_context\IHelper as IHelper;

        interface IPersonTypesHelper extends IHelper { }
    }
?>