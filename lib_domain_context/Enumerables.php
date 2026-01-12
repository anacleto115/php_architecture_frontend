<?php
    namespace lib_domain_context
    {
        class Types
        {
            const Persons = 0, 
                  PersonTypes = 1;
        }
        
        class Architecture
        {
            const StandAlone = 0, 
                  Services = 1;
        }
        
        class Loading
        {
            const ADD = 0, 
                  REMOVE = 1;
        }
        
        class Action
        {
            const OPEN = 0, 
                  CLOSE = 1;
        }
    }
?>