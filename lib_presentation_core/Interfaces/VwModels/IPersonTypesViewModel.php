<?php
    namespace lib_presentation_core\Interfaces\VwModels
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IViewModel.php';

        use lib_domain_context\IViewModel as IViewModel;

        interface IPersonTypesViewModel extends IViewModel { }
    }
?>