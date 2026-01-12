<?php
    namespace lib_presentation_context\Core
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IParser.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IConfiguration.php';

        use lib_domain_context\IParser as IParser;
        use lib_domain_context\IConfiguration as IConfiguration;

        class Helper
        {
            protected ?IParser $IParser = null;
            protected ?IConfiguration $IConfiguration = null;
    
            public function Load(array $data): array
            {
                $data["Client"] = "Default";
                return $data;
            }
        }
    }
?>