<?php
    namespace lib_language\Maintenances
    {
        class RsPersonTypes
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
                $this->data["clName"] = "NAME";
                $this->data["lbName"] = "Name*: ";
                $this->data["lbSubTitle"] = "Person type";
                $this->data["lbTitle"] = "Person types";
            }
            
            public function Es(): void
            {
                $this->data["clName"] = "NOMBRE";
                $this->data["lbName"] = "Nombre*: ";
                $this->data["lbSubTitle"] = "Tipo de persona";
                $this->data["lbTitle"] = "Tipos de personas";
            }
        }
    }

?>