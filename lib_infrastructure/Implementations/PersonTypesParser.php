<?php
    namespace lib_infrastructure\Implementations
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IParser.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_entities/Models/PersonTypes.php';

        use lib_domain_context\IParser as IParser;
        use lib_domain_entities\Models\PersonTypes as PersonTypes;

        class PersonTypesParser implements IParser
        {
            public function CreateEntity(array $ItemArray): object
            {
                $entity = new PersonTypes();
                $entity->SetId($ItemArray[0]);
                if ($ItemArray[1] != null)
                    $entity->SetName($ItemArray[1]);
                return $entity;
            }
    
            public function ToEntity(array $data): object
            {
                $entity = new PersonTypes();
                $entity->SetId($data["Id"]);
                if (array_key_exists("Name", $data))
                    $entity->SetName($data["Name"]);
                return $entity;
            }
    
            public function ToDictionary(object $entity): array
            {
                $response = array();
                $response["Id"] = $entity->GetId();
                if ($entity->GetName() != null && $entity->GetName() != "")
                    $response["Name"] = $entity->GetName();
                return $response;
            }
    
            public function Validate(object $entity): bool
            {
                if ($entity->GetName() == null || $entity->GetName() == "")
                    return false;
                return true;
            }
        }
    }
?>