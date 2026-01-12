<?php
    namespace lib_presentation_context\Core
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IHelper.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IFactory.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/Enumerables.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_presentation_context/Implementations/Helpers/Communications/PersonTypesHelper.php';

        use lib_domain_context\IHelper as IHelper;
        use lib_domain_context\IFactory as IFactory;
        use lib_domain_context\Types as Types;
        use lib_presentation_context\Implementations\Helpers\Communications\PersonTypesHelper as PersonTypesHelper;

        class FactoryHelComContext implements IFactory
        {
            public function Get(array $data): object
            {
                $type = $data["Type"];
                switch ($type)
                {
                    case Types::PersonTypes: return new PersonTypesHelper($data);
                    default: return null;
                }
            }
        }
    }
?>