<?php
    namespace lib_domain_context
    {
        interface IHelper
        {
            function Select(array $data): array;
            function Insert(array $data): array;
            function Update(array $data): array;
            function Delete(array $data): array;
        }
    }
?>