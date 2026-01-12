<?php
    namespace lib_language\Maintenances
    {
        class RsHome
        {
            private $data = null;

            public function __construct(string $language) 
            { 
                $this->data = array();
                $this->Load($language);
            }

            public function Get(): array
            {
                return $this->data;
            }

            public function Load(string $language): void
            {
                switch ((string)$language)
                {
                    case "Es": $this->Es(); break;
                    default: $this->En(); break;
                }
            }

            public function En(): void
            {
                $this->data["lbTitle"] = "Welcome";
            }
            
            public function Es(): void
            {
                $this->data["lbTitle"] = "Bienvenido";
            }
        }
    }

?>