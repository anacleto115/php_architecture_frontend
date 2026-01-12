<?php
    namespace lib_domain_context
    {
        interface IFactory
        {
            function Get(array $data): ?object;
        }
    }
?>