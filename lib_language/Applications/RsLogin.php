<?php
    namespace lib_language\Applications
    {
        class RsLogin
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
                $this->data["lbPassword"] = "Password: ";
                $this->data["lbTitle"] = "LOGIN";
                $this->data["lbUser"] = "User: ";
            }
            
            public function Es(): void
            {
                $this->data["lbPassword"] = "Contraseña: ";
                $this->data["lbTitle"] = "INICIO DE SESIÓN";
                $this->data["lbUser"] = "Usuario: ";
            }
        }
    }

?>