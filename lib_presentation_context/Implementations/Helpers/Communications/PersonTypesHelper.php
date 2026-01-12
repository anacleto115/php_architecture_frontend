<?php
    namespace lib_presentation_context\Implementations\Helpers\Communications
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_infrastructure/Implementations/PersonTypesParser.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/Enumerables.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_presentation_core/Interfaces/Helpers/IPersonTypesHelper.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_communication_core/Core/FactoryCommunication.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_presentation_context/Core/HelperCommunication.php';

        use lib_infrastructure\Implementations\PersonTypesParser as PersonTypesParser;
        use lib_domain_context\Types as Types;
        use lib_presentation_context\Core\HelperCommunication as HelperCommunication;
        use lib_presentation_core\Interfaces\Helpers\IPersonTypesHelper as IPersonTypesHelper;
        use lib_communication_core\Core\FactoryCommunication as FactoryCommunication;

        class PersonTypesHelper extends HelperCommunication implements IPersonTypesHelper
        {
            public function __construct(array $data) 
            { 
                
            }
            
            public function Load(array $data): array
            {
                $data = parent::Load($data);
                $this->IParser = new PersonTypesParser();
                $data["Type"] = Types::PersonTypes;
                if (!array_key_exists("ICommunication", $data))
                    $this->ICommunication = $this->ICommunication ?? FactoryCommunication::Get($data);
                unset($data["Type"]);
                return $data;
            }
        }
    }
?>