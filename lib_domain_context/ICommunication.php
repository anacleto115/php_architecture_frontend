<?php
    namespace lib_domain_context
    {
        interface ICommunication
        {
            function Select(array $data): array;
            function Insert(array $data): array;
            function Update(array $data): array;
            function Delete(array $data): array;
        }
    }
?>