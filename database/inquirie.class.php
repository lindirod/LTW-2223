<?php

    declare(strict_types = 1);

    class Inquirie{

        public int $idInquirie;
        public string $content;
        public $date;

        public int $idUser;

        public int $idTicket;

        public function __construct(int $idInquirie, string $content, $date,
          int $idUser, int $idTicket){
            
            $this->idInquirie = $idInquirie;
            $this->content = $content;
            $this->date = $date;
            $this->idUser = $idUser;
            $this->idTicket = $idTicket;

        }


    }

?>