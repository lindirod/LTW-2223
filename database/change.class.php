<?php
    declare(strict_types = 1);

    class Change{

        public int $idChange;
        public $date;
        public int $idTicket;


        public function __construct(int $idChange, string $date, $idTicket){
            
            $this->idChange = $idChange;
            $this->date = $date;
            $this->idTicket = $idTicket;
        }

    }

    class HashTagChange extends Change{
        
        public string $oldHashtag;
        public function __construct(int $idChange, string $date, int $idTicket, string $oldHashtag){
            parent::__construct($idChange, $date, $idTicket);
            $this->oldHashtag = $oldHashtag;
        }

    }

    class DescriptionChange extends Change{
        
        public string $oldDescription;
        public function __construct(int $idChange, string $date, int $idTicket, string $oldDescription){
            parent::__construct($idChange, $date, $idTicket);
            $this->oldDescription = $oldDescription;
        }

    }

    class DepartmentChange extends Change{
        
        public string $oldDepartment;
        public function __construct(int $idChange, string $date, int $idTicket, string $oldDepartment){
            parent::__construct($idChange, $date, $idTicket);
            $this->oldDepartment = $oldDepartment;
        }

    }

    class AgentChange extends Change{
        
        public int $oldAgent;
        public function __construct(int $idChange, string $date, int $idTicket, int $oldAgent){
            parent::__construct($idChange, $date, $idTicket);
            $this->oldAgent = $oldAgent;
        }

    }

?>