<?php
    namespace lib_domain_context
    {
        interface IScreen
        {
            function Loading(int $action) : void;
            function MoveFocus() : void;
            function Change(array $data) : void;
        }
    }
?>