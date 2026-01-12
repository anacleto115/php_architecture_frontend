<?php
    namespace lib_domain_context
    {
        interface IViewModel
        {
            public function SetCurrent(?object $v): void;
            public function GetCurrent(): ?object; 
            public function SetCurrentCopy(?object $v): void;
            public function GetCurrentCopy(): ?object; 
            public function SetList(array $v): void;
            public function GetList(): array; 

            function Select(array $data): array;
            function New(array $data): array;
            function Modify(array $data): array;
            function Save(array $data): array;
            function Delete(array $data): array;
            function Close(array $data): array;
        }
    }
?>