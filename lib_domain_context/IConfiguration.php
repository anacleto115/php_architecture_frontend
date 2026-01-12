<?php
    namespace lib_domain_context
    {
        interface IConfiguration
        {
            function Get(string $key): string;
        }
    }
?>