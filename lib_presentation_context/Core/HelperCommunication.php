<?php
    namespace lib_presentation_context\Core
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_presentation_context/Core/Helper.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IHelper.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/ICommunication.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_presentation_core/Core/FactoryHelper.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_presentation_context/Core/FactoryHelComContext.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IMessage.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_presentation_context/Core/ErrorHelper.php';
        
        use lib_domain_context\IHelper as IHelper;
        use lib_presentation_context\Core\Helper as Helper;
        use lib_domain_context\ICommunication as ICommunication;
        use lib_communication_core\Core\FactoryCommunication as FactoryCommunication;
        use lib_communication_context\Core\FactoryCommunicationContext as FactoryCommunicationContext;
        use lib_domain_context\MessagesHelper as MessagesHelper;
        use lib_presentation_context\Core\ErrorHelper as ErrorHelper;

        class HelperCommunication extends Helper implements IHelper
        {
            protected ?ICommunication $ICommunication = null;
    
            public function Load(array $data): array
            {
                $data = parent::Load($data);
                if (FactoryCommunication::$IFactoryCommunication == null)
                    FactoryCommunication::$IFactoryCommunication = new FactoryCommunicationContext();
                if (array_key_exists("IApplication", $data))
                    $this->IApplication = $data["IApplication"];
                return $data;
            }
    
            public function Select(array $data): array
            {
                $response = array();
                try
                {
                    $this->Load($data);
                    $response = $this->ICommunication->Select($data);
                    if (array_key_exists("Error", $response))
                    {
                        MessagesHelper::Show(
                            ErrorHelper::GetMessage($response["Error"]));
                        return $response;
                    }
                    if ($this->IParser != null && 
                        array_key_exists("Entities", $response))
                    {
                        $list = array();
                        foreach ($response["Entities"] as $item)
                            array_push($list, $this->IParser->ToEntity($item));
                        $response["Entities"] = $list;
                    }
                    return $response;
                }
                catch (Exception $ex)
                {
                    $response["Error"] = $ex->getMessage();
                    return $response;
                }
            }
    
            public function Insert(array $data): array
            {
                $response = array();
                try
                {
                    $this->Load($data);
                    if ($this->IParser != null &&
                        array_key_exists("Entity", $data) &&
                        !$this->IParser->Validate($data["Entity"]))
                    {
                        $response["Error"] = "lbMissingInfo";
                        MessagesHelper::Show(
                            ErrorHelper::GetMessage($response["Error"]));
                        return $response;
                    }
                    if ($this->IParser != null &&
                        array_key_exists("Entity", $data))
                        $data["Entity"] = $this->IParser->ToDictionary($data["Entity"]);
                    $response = $this->ICommunication->Insert($data);
                    if (array_key_exists("Error", $response))
                    {
                        MessagesHelper::Show(
                            ErrorHelper::GetMessage($response["Error"]));
                        return $response;
                    }
                    if ($this->IParser != null &&
                        array_key_exists("Entity", $response))
                        $response["Entity"] = $this->IParser->ToEntity($response["Entity"]);
                    return $response;
                }
                catch (Exception $ex)
                {
                    $response["Error"] = $ex->getMessage();
                    return $response;
                }
            }
    
            public function Update(array $data): array
            {
                $response = array();
                try
                {
                    $this->Load($data);
                    if ($this->IParser != null &&
                        array_key_exists("Entity", $data) &&
                        !$this->IParser->Validate($data["Entity"]))
                    {
                        $response["Error"] = "lbMissingInfo";
                        MessagesHelper::Show(
                            ErrorHelper::GetMessage($response["Error"]));
                        return $response;
                    }
                    if ($this->IParser != null &&
                        array_key_exists("Entity", $data))
                        $data["Entity"] = $this->IParser->ToDictionary($data["Entity"]);
                    $response = $this->ICommunication->Update($data);
                    if (array_key_exists("Error", $response))
                    {
                        MessagesHelper::Show(
                            ErrorHelper::GetMessage($response["Error"]));
                        return $response;
                    }
                    if ($this->IParser != null &&
                        array_key_exists("Entity", $response))
                        $response["Entity"] = $this->IParser->ToEntity($response["Entity"]);
                    return $response;
                }
                catch (Exception $ex)
                {
                    $response["Error"] = $ex->getMessage();
                    return $response;
                }
            }
    
            public function Delete(array $data): array
            {
                $response = array();
                try
                {
                    $this->Load($data);
                    if ($this->IParser != null &&
                        array_key_exists("Entity", $data) &&
                        !$this->IParser->Validate($data["Entity"]))
                    {
                        $response["Error"] = "lbMissingInfo";
                        MessagesHelper::Show(
                            ErrorHelper::GetMessage($response["Error"]));
                        return $response;
                    }
                    if ($this->IParser != null &&
                        array_key_exists("Entity", $data))
                        $data["Entity"] = $this->IParser->ToDictionary($data["Entity"]);
                    $response = $this->ICommunication->Delete($data);
                    if (array_key_exists("Error", $response))
                    {
                        MessagesHelper::Show(
                            ErrorHelper::GetMessage($response["Error"]));
                        return $response;
                    }
                    if ($this->IParser != null &&
                        array_key_exists("Entity", $response))
                        $response["Entity"] = $this->IParser->ToEntity($response["Entity"]);
                    return $response;
                }
                catch (Exception $ex)
                {
                    $response["Error"] = $ex->getMessage();
                    return $response;
                }
            }
        }
    }
?>