<?php
    namespace lib_domain_context
    {
        interface IEntities
        {
            function Get_Id(): int;
            function GetClone(): object;
        }
    }
?>