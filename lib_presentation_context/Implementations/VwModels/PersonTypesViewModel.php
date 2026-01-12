<?php
    namespace lib_presentation_context\Implementations\VwModels
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IViewModel.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_presentation_core/Core/FactoryHelper.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_entities/Models/PersonTypes.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_presentation_core/Interfaces/VwModels/IPersonTypesViewModel.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/Enumerables.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_presentation_context/Core/VModel.php';

        use lib_presentation_context\Core\VModel as VModel;
        use lib_domain_context\IViewModel as IViewModel;
        use lib_domain_context\Types as Types;
        use lib_presentation_core\Core\FactoryHelper as FactoryHelper;
        use lib_domain_entities\Models\PersonTypes as PersonTypes;
        use lib_presentation_core\Interfaces\VwModels\IPersonTypesViewModel as IPersonTypesViewModel;

        class PersonTypesViewModel extends VModel implements IPersonTypesViewModel
        {
            public function __construct(array $data) 
            { 
                parent::__construct($data);
            }

            public function Load(array $data): array
            {
                try
                {
                    $data = parent::Load($data);
                    $data["Type"] = Types::PersonTypes;
                    if (!array_key_exists("IHelper", $data))
                        $this->IHelper = $this->IHelper ?? FactoryHelper::Get($data);
                }
                catch (Exception $ex)
                {
                    LogHelper::Log($ex);
                }
                return $data;
            }
    
            public function CreateNew(): ?object { return new PersonTypes(); }
        }
    }
?>