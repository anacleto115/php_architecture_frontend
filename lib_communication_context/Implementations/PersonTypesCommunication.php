<?php
    namespace lib_communication_context\Implementations
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_communication_core/Interfaces/IPersonTypesCommunication.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_communication_context/Core/Communication.php';

        use lib_communication_core\Interfaces\IPersonTypesCommunication as IPersonTypesCommunication;
        use lib_communication_context\Core\Communication as Communication;

        class PersonTypesCommunication extends Communication implements IPersonTypesCommunication
        {
            public function __construct(array $data) 
            { 
                
            }
            
            public function Load(array $data): array
            {
                $data = parent::Load($data);
                $this->Service = "srw_persons";
                $this->Name = "PersonTypes";
                return $data;
            }
        }
    }
?>