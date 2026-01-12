<?php
    namespace lib_language
    {
        class RsMessages
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
                $this->data["lbActive"] = "Active";
                $this->data["lbDeleteEntity"] = "Do you want to delete the selected item?";
                $this->data["lbExists"] = "The item is already exist.";
                $this->data["lbInactive"] = "Inactive";
                $this->data["lbLoading"] = "Loading...";
                $this->data["lbMessage"] = "Message";
                $this->data["lbNoExist"] = "The information no longer exists.";
                $this->data["lbSelectItem"] = "Please, select a item in the list.";
                $this->data["lbSqlError"] = "Please, contact to your administrator.";
                $this->data["lbThisIsInUse"] = "This item is in used, you cannot delete it.";
                $this->data["lbTryAgain"] = "Please, try again.";
                $this->data["lbMissingInfo"] = "Please check, there is missing information.";
            }
            
            public function Es(): void
            {
                $this->data["lbActive"] = "Activo";
                $this->data["lbDeleteEntity"] = "¿Desea eliminar el elemento seleccionado?";
                $this->data["lbExists"] = "El elemento ya existe.";
                $this->data["lbInactive"] = "Inactivo";
                $this->data["lbLoading"] = "Cargando...";
                $this->data["lbMessage"] = "Mensaje";
                $this->data["lbNoExist"] = "La información ya no existe.";
                $this->data["lbSelectItem"] = "Por favor, seleccione un elemento de la lista.";
                $this->data["lbSqlError"] = "Por favor, póngase en contacto con su administrador.";
                $this->data["lbThisIsInUse"] = "Este elemento está en uso, no puede eliminarlo.";
                $this->data["lbTryAgain"] = "Por favor, intente de nuevo.";
                $this->data["lbMissingInfo"] = "Por favor verifique, falta información.";
            }
        }
    }

?>