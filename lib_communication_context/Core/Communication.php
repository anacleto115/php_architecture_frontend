<?php
    namespace lib_communication_context\Core
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/ICommunication.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/ICaller.php';

        use lib_domain_context\ICommunication as ICommunication;
        use lib_domain_context\ICaller as ICaller;
        use lib_domain_context\FactoryCaller as FactoryCaller;

        class Communication implements ICommunication
        {
            protected ?ICaller $client = null;
            public string $Name = "",
                          $Service = "",
                          $End = "";
            public static string $Protocol = "http://",
                          $Base = "192.168.0.35",
                          $CreateBy = "Communication";
    
            public function Load(array $data): array
            {
                if ($this->client == null)
                    $this->client = FactoryCaller::Get($data);
                return $data;
            }
    
            protected function BuildUrl(array $data, string $Method): array
            {
                $data["Url"] = Communication::$Protocol . Communication::$Base . "/" . $this->Service . "/" . $this->Name . "/" . $Method . $this->End;
                $data["UrlToken"] = Communication::$Protocol . Communication::$Base . "/" . $this->Service . "/Token/Authenticate" . $this->End;
                if (array_key_exists("create_by", $data))
                    $data["create_by"] = Communication::$CreateBy;
                return $data;
            }
    
            public function Select(array $data): array
            {
                $data = $this->Load($data);
                $data = $this->BuildUrl($data, "Select");
                return $this->client->Execute($data);
            }
    
            public function Insert(array $data): array
            {
                $data = $this->Load($data);
                $data = $this->BuildUrl($data, "Insert");
                return $this->client->Execute($data);
            }
    
            public function Update(array $data): array
            {
                $data = $this->Load($data);
                $data = $this->BuildUrl($data, "Update");
                return $this->client->Execute($data);
            }
    
            public function Delete(array $data): array
            {
                $data = $this->Load($data);
                $data = $this->BuildUrl($data, "Delete");
                return $this->client->Execute($data);
            }
        }
    }
?>