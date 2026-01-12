<?php
    namespace lib_language
    {
        class RsMenu
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
                $this->data["lbAccept"] = "Accept";
                $this->data["lbAction"] = "ACTION";
                $this->data["lbApp"] = "PersonsApp";
                $this->data["lbApplications"] = "Applications";
                $this->data["lbCancel"] = "Cancel";
                $this->data["lbClean"] = "Clean";
                $this->data["lbClose"] = "Close";
                $this->data["lbEnter"] = "Enter";
                $this->data["lbHome"] = "Home";
                $this->data["lbMaintenances"] = "Maintenances";
                $this->data["lbPersons"] = "Persons";
                $this->data["lbPersonTypes"] = "Person types";

                $this->data["lbNew"] = "New";
                $this->data["lbSave"] = "Save";
                $this->data["lbEdit"] = "Edit";
                $this->data["lbSelect"] = "Load";
                $this->data["lbInsert"] = "Create";
                $this->data["lbUpdate"] = "Modify";
                $this->data["lbDelete"] = "Delete";
                $this->data["lbChoose"] = "CHOOSE";
                $this->data["lbCompleted"] = "Completed";
            }
            
            public function Es(): void
            {
                $this->data["lbAccept"] = "Aceptar";
                $this->data["lbAction"] = "ACCIÓN";
                $this->data["lbApp"] = "PersonsApp";
                $this->data["lbApplications"] = "Aplicaciones";
                $this->data["lbCancel"] = "Cancelar";
                $this->data["lbClean"] = "Limpiar";
                $this->data["lbClose"] = "Cerrar";
                $this->data["lbEnter"] = "Entrar";
                $this->data["lbHome"] = "Inicio";
                $this->data["lbMaintenances"] = "Mantenimientos";
                $this->data["lbPersons"] = "Personas";
                $this->data["lbPersonTypes"] = "Tipos de personas";
        
                $this->data["lbNew"] = "Nuevo";
                $this->data["lbSave"] = "Guardar";
                $this->data["lbEdit"] = "Editar";
                $this->data["lbSelect"] = "Cargar";
                $this->data["lbInsert"] = "Crear";
                $this->data["lbUpdate"] = "Modificar";
                $this->data["lbDelete"] = "Borrar";
                $this->data["lbChoose"] = "SELECCIONAR";
                $this->data["lbCompleted"] = "Completado";
            }
        }
    }

?>