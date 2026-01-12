<?php 
    namespace php_persons
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_presentation_context/Implementations/VwModels/PersonTypesViewModel.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IScreen.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_entities/Models/PersonTypes.php';

        use lib_domain_context\IScreen as IScreen;
        use lib_presentation_context\Implementations\VwModels\PersonTypesViewModel as PersonTypesViewModel;
        use lib_domain_entities\Models\PersonTypes as PersonTypes;

        class indexForm implements IScreen
        {
            public bool $listDetail = true;
            public bool $logged = true; 
            public bool $showPopup = false; 
            public bool $showDelete = false;
            public string $message = ""; 
            public ?PersonTypes $current = null; 
            public array $list = array();
            public ?PersonTypesViewModel $vwModel = null;

            public function __construct() 
            { 
                $this->current = new PersonTypes();
                $data = array();
                $data["View"] = $this;
                $this->vwModel = new PersonTypesViewModel($data);
            }

            public function Loading(int $action) : void { }

            public function MoveFocus() : void { }
            
            public function Change(array $data) : void { }

            public function CheckLogged(): void
            {
                $this->logged = true;
            }

            public function SetData($post, $files): void
            {
                if ($post == null)
                    return;
                if (array_key_exists('ListDetail', $post)) 
                    $this->listDetail = $post["ListDetail"] == 1;
                    
                if ($files == null)
                    return;
            }

            public function Load(): void
            {
                $data = array();
                $response = $this->vwModel->Select($data);
                if ($response == null ||
                    array_key_exists("Error", $response))
                {
                    $this->message = $response["Error"];
                    return;
                }
    
                $this->list = $response["Entities"];
            }
            
            public function Close(): void
            {
                $this->message = ""; 
            }
            
            public function Cancel(): void
            {
                $this->listDetail = true; 
            }
        }
    }
?>