<?php
    namespace lib_domain_entities\Models
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/IEntities.php';

        use lib_domain_context\IEntities as IEntities;

        class PersonTypes implements IEntities
        {
            private int $id = 0;
    
            public function SetId(int $value): void { $this->id = $value; }
            public function GetId(): int { return $this->id; } 
    
            private ?string $name = null;
    
            public function SetName(?string $value): void { $this->name = $value; }
            public function GetName(): ?string { return $this->name; } 
    
            public function Get_Id(): int { return $this->id; }
            public function GetClone(): PersonTypes { return clone $this; }
        }
    }
?>