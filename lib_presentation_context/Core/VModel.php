<?php
    namespace lib_presentation_context\Core
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_language/Bundle.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IViewModel.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IScreen.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IHelper.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/Enumerables.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/ILogHelper.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_presentation_core/Core/FactoryHelper.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_presentation_context/Core/FactoryHelperContext.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IMessage.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_utilities/Utilities/PLinq.php';

        use lib_language\Bundle as Bundle;
        use lib_domain_context\IViewModel as IViewModel;
        use lib_domain_context\IScreen as IScreen;
        use lib_domain_context\IHelper as IHelper;
        use lib_domain_context\Action as Action;
        use lib_domain_context\Message as Message;
        use lib_domain_context\Loading as Loading;
        use lib_domain_context\LogHelper as LogHelper;
        use lib_presentation_core\Core\FactoryHelper as FactoryHelper;
        use lib_presentation_context\Core\FactoryHelperContext as FactoryHelperContext;
        use lib_domain_context\MessagesHelper as MessagesHelper;
        use lib_utilities\Utilities\PLinq as PLinq;
        use lib_domain_context\Architecture as Architecture;

        abstract class VModel implements IViewModel
        {
            protected ?object $current = null;
            protected ?object $currentCopy = null;
            protected array $list, $copy;
            protected ?IScreen $IScreen;
            protected ?IHelper $IHelper;
            protected int $architecture = Architecture::Services;
            protected bool $isLoading = false;
            protected int $fontSize = 16;
            protected string $lbSelectItem, $lbDeleteEntity;
    
            public function __construct(array $data) 
            { 
                try
                {
                    if (array_key_exists("Architecture", $data))
                    {
                        $this->architecture = $data["Architecture"];
                        unset($data["Architecture"]);
                    }
                    if (array_key_exists("View", $data))
                    {
                        $this->IScreen = $data["View"];
                        unset($data["View"]);
                    }
                    $this->Resources();
                    if (array_key_exists("IHelper", $data))
                    {
                        $this->IHelper = $data["IHelper"];
                        unset($data["IHelper"]);
                    }
                    $this->list = array();
                }
                catch (Exception $ex)
                {
                    LogHelper::Log($ex);
                }
            }

            public function SetIsLoading(int $v): void { $this->isLoading = $v; }
            public function GetIsLoading(): int { return $this->isLoading; }
            public function SetCurrent(?object $v): void { $this->current = $v; }
            public function GetCurrent(): ?object { return $this->current; }
            public function SetCurrentCopy(?object $v): void { $this->currentCopy = $v; }
            public function GetCurrentCopy(): ?object { return $this->currentCopy; }
            public function SetList(array $v): void { $this->list = $v; }
            public function GetList(): array { return $this->list; } 
            public function SetFontSize(int $v): void { $this->fontSize = $v; }
            public function GetFontSize(): int { return $this->fontSize; }

            abstract function CreateNew(): ?object;            
            public function GetItem(?object $t): ?object
            {
                return PLinq::From($this->list)->FirstOrDefault(
                    function($x) use($t) { return $x->Get_Id() == $t->Get_Id(); });
            }
            public function CreateCopy(): void
            {
                if ($this->current == null)
                    return;
                $this->currentCopy = $this->current->GetClone();
            }
            public function Comparer(?object $t1, ?object $t2): bool { return false; }
    
            public function Resources(): void
            {
                $this->lbSelectItem = Bundle::Get("RsMessages", "lbSelectItem");
                $this->lbDeleteEntity = Bundle::Get("RsMessages", "lbDeleteEntity");
            }

            public function Load(array $data): array
            {
                if (FactoryHelper::$IFactoryHelper == null)
                    FactoryHelper::$IFactoryHelper = new FactoryHelperContext();
                $data["Architecture"] = $this->architecture;
                return $data;
            }

            function New(array $data): array
            {
                $response = array();
                try
                {
                    $this->currentCopy = $this->CreateNew();
                    $data = $data == null ? array() : $data;
                    $data["Action"] = Action::OPEN;
                    $this->IScreen->Change($data);
                    return $response;
                }
                catch (Exception $ex)
                {
                    LogHelper::Log($ex);
                    $response["Error"] = $ex->getMessage();
                    return $response;
                }
            }

            function Modify(array $data): array
            {
                $response = array();
                try
                {
                    if ($this->current == null)
                        return $response;
                    $this->CreateCopy();
                    $data = $data == null ? array() : $data;
                    $data["Action"] = Action::OPEN;
                    $this->IScreen->Change($data);
                    return $response;
                }
                catch (Exception $ex)
                {
                    LogHelper::Log($ex);
                    $response["Error"] = $ex->getMessage();
                    return $response;
                }
            }

            function Select(array $data): array
            {
                $response = array();
                try
                {
                    $this->isLoading = true;
                    $this->IScreen->Loading(Loading::ADD);
                    $data = $data == null ? array() : $data;
                    $data = $this->Load($data);
                    $response = $this->IHelper->Select($data);
                    if ($response == null || 
                        !array_key_exists("Entities", $response))
                        return $response;
                    $this->list = array();
                    $temp = $response["Entities"];
                    foreach ($temp as $item)
                        array_push($this->list, $item);
                    //$this->current = $this->list[0];
                    $this->copy = array($this->list);
                    $this->Close($data);
                    return $response;
                }
                catch (Exception $ex)
                {
                    LogHelper::Log($ex);
                    $response["Error"] = $ex->getMessage();
                    return $response;
                }
                finally
                {
                    $this->isLoading = false;
                    $this->IScreen->Loading(Loading::REMOVE);
                }
            }

            function Delete(array $data): array
            {
                $response = array();
                try
                {
                    $this->isLoading = true;
                    $this->IScreen->Loading(Loading::ADD);
                    $data = $data == null ? array() : $data;
                    $data = $this->Load($data);
                    if (array_key_exists("Entity", $data))
                        $this->current = $data["Entity"];
                    if (!array_key_exists("Entity", $data))
                        $data["Entity"] = $this->current;

                    if ($this->current == null)
                        return $response;
                    if (!MessagesHelper::Show($this->lbDeleteEntity, Message::QUESTION))
                        return $response;
    
                    $response = $this->IHelper->Delete($data);
                    if ($response == null || 
                        array_key_exists("Error", $response))
                        return $response;
                    $this->current = $response["Entity"];
                    if ($this->current != null)
                    {
                        $this->current = $this->GetItem($this->current);
                        $key = array_search($this->current, $this->list);
                        unset($this->list[$key]);
                        $this->current = null;
                        $this->currentCopy = null;
                    }
                    $this->Close($data);
                    return $response;
                }
                catch (Exception $ex)
                {
                    LogHelper::Log($ex);
                    $response["Error"] = $ex->getMessage();
                    return $response;
                }
                finally
                {
                    $this->isLoading = false;
                    $this->IScreen->Loading(Loading::REMOVE);
                }
            }

            function Save(array $data): array
            {
                $response = array();
                try
                {
                    $this->isLoading = true;
                    $this->IScreen->MoveFocus();
                    $this->IScreen->Loading(Loading::ADD);
                    
                    $data = $data == null ? array() : $data;
                    $data = $this->Load($data);
                    if (array_key_exists("Entity", $data))
                        $this->currentCopy = $data["Entity"];
                    if (!array_key_exists("Entity", $data))
                        $data["Entity"] = $this->currentCopy;
                    
                    if ($this->currentCopy == null)
                        return $response;
                    if ($this->currentCopy->Get_Id() == 0)
                    {
                        $response = $this->IHelper->Insert($data);
                        if ($response == null || 
                            array_key_exists("Error", $response))
                            return $response;
                        $this->currentCopy = $response["Entity"];
                        $this->current = $this->currentCopy;
                        array_push($this->list, $this->current);
                    }
                    else if ($this->currentCopy->Get_Id() != 0 &&
                        !$this->Comparer($this->current, $this->currentCopy))
                    {
                        $response = $this->IHelper->Update($data);
                        if ($response == null || 
                            array_key_exists("Error", $response))
                            return $response;
                        $this->currentCopy = $response["Entity"];
                        $this->current = $this->GetItem($this->current);
                        $key = array_search($this->current, $this->list);
                        unset($this->list[$key]);
                        array_push($this->list, $this->currentCopy);
                        $this->currentCopy = null;
                    }
                    if ($response != null || 
                        !array_key_exists("Error", $response))
                        $this->Close($data);
                    return $response;
                }
                catch (Exception $ex)
                {
                    LogHelper::Log($ex);
                    $response["Error"] = $ex->getMessage();
                    return $response;
                }
                finally
                {
                    $this->isLoading = false;
                    $this->IScreen->Loading(Loading::REMOVE);
                }
            }

            function Close(array $data): array
            {
                $response = array();
                try
                {
                    $data = $data == null ? array() : $data;
                    $data["Action"] = Action::CLOSE;
                    $this->IScreen->Change($data);
                    return $response;
                }
                catch (Exception $ex)
                {
                    LogHelper::Log($ex);
                    $response["Error"] = $ex->getMessage();
                    return $response;
                }
            }
        }
    }
?>