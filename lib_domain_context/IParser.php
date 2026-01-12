<?php
    namespace lib_domain_context
    {
        interface IParser
        {
            function CreateEntity(array $ItemArray) : object;
            function ToEntity(array $data) : object;
            function ToDictionary(object $entity) : array;
            function Validate(object $entity) : bool;
        }
    }
?>