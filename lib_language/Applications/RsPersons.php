<?php
    namespace lib_language\Applications
    {
        class RsPersons
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
                $this->data["clBorn"] = "BORN";
                $this->data["clFile"] = "FILE";
                $this->data["clName"] = "NAME";
                $this->data["clSSN"] = "SSN";
                $this->data["clState"] = "STATE";
                $this->data["clType"] = "TYPE";
                $this->data["lbBorn"] = "Born*: ";
                $this->data["lbFile"] = "File: ";
                $this->data["lbName"] = "Name*: ";
                $this->data["lbSSN"] = "SSN*: ";
                $this->data["lbState"] = "State: ";
                $this->data["lbSubTitle"] = "Person";
                $this->data["lbTitle"] = "Persons";
                $this->data["lbType"] = "Type*: ";
            }
            
            public function Es(): void
            {
                $this->data["lbTitle"] = "Bienvenido";
                $this->data["clBorn"] = "FECHA N.";
                $this->data["clFile"] = "ARCHIVO";
                $this->data["clName"] = "NOMBRE";
                $this->data["clSSN"] = "CEDULA";
                $this->data["clState"] = "ESTADO";
                $this->data["clType"] = "TIPO";
                $this->data["lbBorn"] = "Fecha n*: ";
                $this->data["lbFile"] = "Archivo: ";
                $this->data["lbName"] = "Nombre*: ";
                $this->data["lbSSN"] = "Cedula*: ";
                $this->data["lbState"] = "Estado: ";
                $this->data["lbSubTitle"] = "Persona";
                $this->data["lbTitle"] = "Personas";
                $this->data["lbType"] = "Tipo*: ";
            }
        }
    }

?>