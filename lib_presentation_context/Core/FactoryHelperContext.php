<?php
    namespace lib_presentation_context\Core
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IHelper.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IFactory.php';
        //require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_presentation_context/Core/FactoryHelAppContext.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_presentation_context/Core/FactoryHelComContext.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/Enumerables.php';
        
        use lib_domain_context\IHelper as IHelper;
        use lib_domain_context\IFactory as IFactory;
        //use lib_presentation_context\Core\FactoryHelAppContext as FactoryHelAppContext;
        use lib_presentation_context\Core\FactoryHelComContext as FactoryHelComContext;
        use lib_domain_context\Architecture as Architecture;

        class FactoryHelperContext implements IFactory
        {
            //private FactoryHelAppContext $FactoryHelAppContext;
            private FactoryHelComContext $FactoryHelComContext;
    
            public function __construct()
            {
                //$this->FactoryHelAppContext = new FactoryHelAppContext();
                $this->FactoryHelComContext = new FactoryHelComContext();
            }

            public function Get(array $data): object
            {
                //if (array_key_exists("Architecture", $data) &&
                //    $data["Architecture"] == Architecture::StandAlone)
                //    return $this->FactoryHelAppContext->Get($data);
                return $this->FactoryHelComContext->Get($data);
            }
        }
    }
?>