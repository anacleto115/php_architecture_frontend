<?php    
    namespace lib_utilities\Utilities
    {
        class PLinq
        {
            var $data;
            
            private function setList($list)
            {
                $this->data = $list;
            }
            
            public static function From($list) 
            { 
                $imp = new PLinq(); 
                $imp->setList($list);
                return $imp;
            }

            public function Where($where) 
            {
                $response = array();
                foreach ($this->data as $item) 
                    if ($where($item)) // if (call_user_func($where, $item))
                        array_push($response, $item);
                $this->setList($response);
                return $this;
            }
        
            public function Count() { return Count($this->data); }
            public function ToList() { return $this->data; }
            public function AsEnumerable() { return $this->data; }
            public function ToDictionary($where) 
            { 
                $response = array();
                foreach ($this->data as $item)
                    $response->Add($where($item), $item);
                return $response; 
            }
            public function ToArray() { return $this->data; }
            public function Cast($Type) { return $this->OfType($Type); }        
            public function OfType($Type) 
            { 
                $response = array();
                foreach ($this->data as $item)
                    array_push($response, $item);
                return $response;
            }
            
            // Select, Php does not support SelectMany --------------------------------
            public function Select($where) 
            {
                $response = array();
                foreach ($this->data as $item) 
                    if ($where($item))
                        array_push($response, true);
                    else
                        array_push($response, false);
                return $response;
            }
            
            // OrderBy, ThenBy, OrderByDescending, ThenByDescending, Reverse -----------
            public function Order() 
            {
                sort($this->data);
                return $this;
            }
            
            public function Descending() 
            {
                sort($this->data);
                $response = array_reverse($this->data);
                $this->setList($response);
                return $this;
            }
            
            public function OrderBy($where) 
            {
                usort($this->data, $where);
                return $this;
            }
            
            public function OrderByDescending($where) 
            {
                usort($this->data, $where);
                $response = array_reverse($this->data);
                $this->setList($response);
                return $this;
            }
            
            public function Reverse() 
            {
                $response = array_reverse($this->data);
                $this->setList($response);
                return $this;
            }
            
            // Join -------------------------------------------------------------------
            public function Join($list, $where) 
            {
                $response = array();
                $secondArray = $list;
                
                foreach ($this->data as $item) 
                    foreach ($secondArray as $sub_item) 
                        if ($where($item, $sub_item))
                            array_push($response, $item);
                $this->setList($response);
                return $this;
            }
            
            // GroupBy, ToLookup ------------------------------------------------------
            public function ToLookup($column) { return $this->GroupBy($column); }
            
            public function GroupBy($column)
            {
                $map = array();
                if (!empty($orderField)) 
                    $this->data = $this->GetItems($this->data, $orderField);
                foreach ($this->data as $element) 
                {
                    $key = $column($element);
                    $map[$key][] = $element;
                }
                return $map;
            }        
            
            public function GetItems(array $elements, $orderField)
            {
                usort($elements, function ($a, $b) use ($orderField) {
                    return $a->$orderField < $b->$orderField ? -1 : 1;
                });
                return $elements;
            }
        
            // Distinct, Union, Intersect, Except -------------------------------------
            public function Union($list)
            {
                $response = array_merge($this->data, $list->ToList());
                $response = array_unique(array_map("serialize", $response));
                $this->setList($response);
                return $this;
            }

            public function Distinct()
            {
                $response = array_unique(array_map("serialize", $this->data));
                $this->setList($response);
                return $this;
            }
            
            public function Intersect($list)
            {
                //$response = array_uintersect($list->ToList(), $this->data,
                //        function($x, $x2) { return $x->idUser == $x2->idUser; });
                //$this->setList($response);
                //return $this;
                return $this->Join($list, function($x, $x2) { return $x == $x2; });
            }
            
            public function Except($value)
            {
                $response = array();
                foreach ($this->data as $item) 
                    if ($item != $value)
                        array_push($response, $item);
                $this->setList($response);
                return $this;
            }
            
            // Any, All, Contains -----------------------------------------------------
            public function Any($where) 
            {
                foreach ($this->data as $item) 
                    if ($where($item))
                        return true;
                return false;
            }
        
            public function All($where) 
            {
                $all = true;
                foreach ($this->data as $item) 
                {
                    if (!$where($item))
                    {
                        $all = false;
                        break;
                    }
                }
                return $all;
            }
            
            public function Constain($entity) 
            {
                foreach ($this->data as $item) 
                    if ($entity == $item)
                        return true;
                return false;
            }
            
            // Take, Skip, TakeWhile, SkipWhile ---------------------------------------
            public function Take($size) 
            {
                $response = array();
                $count = 0;
                foreach ($this->data as $item) 
                {
                    $count++;
                    array_push($response, $item);
                    if ($size == $count)
                        break;
                }
                $this->setList($response);
                return $this;
            }
            
            public function TakeWhile($where) 
            {
                $response = array();
                foreach ($this->data as $item) 
                {
                    if ($where($item))
                        array_push($response, $item);
                }
                $this->setList($response);
                return $this;
            }
            
            public function Skip($size) 
            {
                $response = array();
                $count = 0;
                foreach ($this->data as $item) 
                {
                    $count++;
                    if ($size == $count)
                        continue;
                    array_push($response, $item);
                }
                $this->setList($response);
                return $this;
            }
            
            public function SkipWhile($where) 
            {
                $response = array();
                foreach ($this->data as $item) 
                {
                    if (!$where($item))
                        array_push($response, $item);
                }
                $this->setList($response);
                return $this;
            }
            
            // First, FirstOrDefault, Last, LastOrDefault, ElementAt, ElementAtOrDefault
            // Single, SingleOrDefault -------------------------------------------------
            public function FirstOrDefault($where) 
            { 
                if (Count($this->data) == 0)
                    return null;
                foreach ($this->data as $item) 
                    if ($where($item))
                        return $item;
                return null;
            }
            public function First() { return $this->data[0]; }
            
            public function LastOrDefault($where) 
            { 
                if (Count($this->data) == 0)
                    return null;
                $response = $this->Where($where)->ToList();
                $response = array_reverse($response);
                foreach ($response as $item) 
                    if ($where($item))
                        return $item;
                return null; 
            }
            public function Last() { return $this->data[Count($this->data) - 1]; }
            
            public function ElementAtOrDefault($position) { return $this->ElementAt($position); }
            
            public function ElementAt($position)
            { 
                if (Count($this->data) < $position)
                    return null;
                return $this->data[$position]; 
            }
            
            public function SingleOrDefault($where) 
            { 
                $response = $this->Where($where)->ToList();
                if (Count($response) > 1)
                    throw new Exception ("The list has more than one item");
                return $response[0]; 
            }
            
            public function Single()
            {
                if (Count($this->data) > 1)
                    throw new Exception ("The list has more than one item");
                return $this->data[0]; 
            }
            
            // Count, Sum, Min, Max, Average, Aggregate ---------------------------------
            public function Sum($where)
            {
                if (empty($this->data))
                    return 0;
                $response = 0;
                foreach ($this->data as $item) 
                    $response = $response + $where($item);
                return $response;
            }
            
            public function Min($where)
            {
                if (empty($this->data))
                    return 0;
                $response = $where($this->data[0]);
                foreach ($this->data as $item) 
                {
                    if ($response > $where($item))
                        $response = $where($item);
                }
                return $response;
            }
            
            public function Max($where)
            {
                if (empty($this->data))
                    return 0;
                $response = $where($this->data[0]);
                foreach ($this->data as $item) 
                {
                    if ($response < $where($item))
                        $response = $where($item);
                }
                return $response;
            }
            
            public function Average($where)
            {
                return $this->Sum($where) / Count($this->data);
            }
        }
    }
?>