<?php
     declare(strict_types = 1); 
     require_once(__DIR__ . '/../database/ticket.class.php');

     class User{
        
        public int $id;
        public string $email;
        public string $name;

        public string $username;

        public function __construct(int $id, string $email, string $name, string $username){
            
            $this->id = $id;
            $this->email = $email;
            $this->name = $name;
            $this->username = $username;
        }

        function getAllDepartments($db){
            $stmt = $db->prepare(
            'SELECT title
            FROM department');

            $stmt->execute();
            $departmentsRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $departments = [];

            foreach ($departmentsRows as $row) {
                array_push($departments, $row['title']);
            }

            return $departments;
        }


        public function getEmail(){
            return $this->email;
        }

        public function getName(){
            return $this->name;
        }

            
        function getIDByName($db,$name){
            $stmt = $db->prepare('
            SELECT 
            idUser FROM users
            WHERE name = ?');
        $stmt->execute(array($name));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row !== false) {
            return $row['idUser'];
        }
     }
        public function getNumberTickets(PDO $db, string $status) : int{
            $stmt = $db->prepare('SELECT count(idClient)
              FROM tickets
              WHERE idClient = ? AND status = ?');
              $stmt->execute(array($this->id, $status));
              $count = $stmt->fetchColumn();
              return intval($count);
        }

        public function getTickets(PDO $db, string $status): array{
            $stmt = $db->prepare('SELECT idTicket, date, title, status, idAgent, idClient, description, department, priority, hashtag FROM tickets WHERE idClient = ? AND status = ?');
            $stmt->execute([$this->id, $status]);
            $ticketRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $tickets = [];
            
            foreach ($ticketRows as $row) {
                $ticket = new Ticket(
                    intval($row['idTicket']),
                    $row['title'],
                    $row['status'],
                    $row['description'],
                    $row['department'],
                    $row['priority'],
                    strval($row['hashtag']),
                    $row['date'],
                    $row['idClient'],
                    intval($row['idAgent']),
                );
                
                array_push($tickets, $ticket);
            }
            
            return $tickets;
        }

        public function getTicketWithID($db, $id){
            $stmt = $db->prepare('SELECT idTicket, date, title, status, description, department, priority, idClient, idAgent, hashtag FROM tickets WHERE idTicket = ?');
            $stmt->execute([$id]);
            $ticketRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $row = $ticketRows[0];
            $ticket = new Ticket(
                $row['idTicket'],
                $row['title'],
                $row['status'],
                $row['description'],
                $row['department'],
                $row['priority'],
                strval($row['hashtag']),
                $row['date'],
                $row['idClient'],
                intval($row['idAgent']),
            );
            return $ticket;
        }


        public function getID(){
            return $this->id;
        }
        
        
        static function getUser(PDO $db, String $email, String $password) : ?User {
            $stmt = $db->prepare('
              SELECT idUser, email, name, username
              FROM users
              WHERE lower(email) = ? AND password = ?');
              $stmt->execute(array(strtolower($email), sha1($password)));

            if ($user = $stmt->fetch()){
                return new User(
                $user['idUser'],
                $user['email'],
                $user['name'],
                $user['username'],
                );
            } else return null;
        }

        
        static function getAllUsers(PDO $db){
            $stmt = $db->prepare('
              SELECT idUser, email, name, username
              FROM users');
            $stmt->execute();
            $ticketRows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $users = [];

            foreach ($ticketRows as $row){
                $user = new User(
                $row['idUser'],
                $row['email'],
                $row['name'],
                $row['username']);
                array_push($users, $user);
            } 
 
            return $users;
        }


        static function getUserWithID(PDO $db, int $id) : ?User {
            $stmt = $db->prepare('
                SELECT u.idUser, u.email, u.name, u.username
                FROM users u JOIN admins a ON u.idUser = a.idAdmin
                WHERE u.idUser = ?');
            $stmt->execute(array($id));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row !== false) {
                return new Admin($row['idUser'], $row['email'], $row['name'], $row['username']);
            }
        
            $stmt = $db->prepare('
                SELECT u.idUser, u.email, u.name, u.username
                FROM users u JOIN agents a ON u.idUser = a.idAgent
                WHERE u.idUser = ?');
            $stmt->execute(array($id));;
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row !== false) {
                return new Agent($row['idUser'], $row['email'], $row['name'], $row['username']);
            }
        
            $stmt = $db->prepare('
                SELECT idUser, email, name, username
                FROM users
                WHERE idUser = ?');
            $stmt->execute(array($id));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row !== false) {
                return new Client($row['idUser'],$row['email'], $row['name'], $row['username']);
            }
        
            return null;
            }
        
        

            function updateUser(PDO $db, $username, $name, $new_pass, $email){
                $stmt = $db->prepare("
                    UPDATE USERS
                    SET name = :name, password = :password, email = :newEmail, username = :username
                    WHERE idUser = :oldEmail
                ");
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':password', $new_pass);
                $stmt->bindParam(':newEmail', $email);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':oldEmail', $this->id);
                $stmt->execute();
            }
        
        static function addUser(PDO $db, $username, $name, $password, $email){

            $stmt = $db->prepare(
                "INSERT INTO Users (email, name, username, password)
                VALUES (:email, :name, :username, :password)"
            );
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            $id = $db->lastInsertId();

          $stmt = $db->prepare(
            "INSERT INTO CLIENTS VALUES ($id)"
          );

          $stmt->execute();
      }
      
      static function getAllAgentsByDepartment(PDO $db, $department, $client){
        $stmt = $db->prepare('
          SELECT idAgent
          FROM departmentUser WHERE idDepartment = ?');
        $stmt->execute([$department]);
        $agentRows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $agents = [];
        foreach ($agentRows as $row){
            if($client->id !== intval($row['idAgent'])){
                array_push($agents,$row['idAgent']);
            }
        } 

        return $agents;
    }
        
     }

     class Admin extends User{

        function getDepartments($db){
            return $this->getAllDepartments($db);
        }
        
        function getNumberTicketsByDepartment($db){
            return "Not an Agent";
        }

        function checkDepartment($db, $department){
            return true;
        }

        function addDepartment($db, $name, $content){
            $stmt = $db->prepare("INSERT INTO department values (?, ?)");
            $stmt->execute([$name, $content]);
            
        }

        function getAllTicketsWithDepartment($db, $department){
            $stmt = $db->prepare('SELECT idTicket, date, status, title, description, department, priority, idClient, idAgent, hashtag FROM tickets WHERE department = ?');
            $stmt->execute([$department]);
            $ticketRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $tickets = [];
            
            foreach ($ticketRows as $row) {
                $ticket = new Ticket(
                    intval($row['idTicket']),
                    $row['title'],
                    $row['status'],
                    $row['description'],
                    $row['department'],
                    $row['priority'],
                    strval($row['hashtag']),
                    $row['date'],
                    $row['idClient'],
                    intval($row['idAgent']),
                );
                
                array_push($tickets, $ticket);
            }
            
            return $tickets;
        }


     }

     class Client extends User{
        
        function upgradeToAgent($db){
            $stmt = $db->prepare(
                "INSERT INTO Agents VALUES ($this->id)"
            );
            $stmt->execute();
        }

    }

    class Agent extends Client{

        function getAllTicketsWithDepartment($db, $department){
            $stmt = $db->prepare('SELECT idTicket, date, status, title, description, department, priority, idClient, idAgent, hashtag FROM tickets WHERE department = ?');
            $stmt->execute([$department]);
            $ticketRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $tickets = [];
            
            foreach ($ticketRows as $row) {
                $ticket = new Ticket(
                    intval($row['idTicket']),
                    $row['title'],
                    $row['status'],
                    $row['description'],
                    $row['department'],
                    $row['priority'],
                    strval($row['hashtag']),
                    $row['date'],
                    $row['idClient'],
                    intval($row['idAgent']),
                );
                
                array_push($tickets, $ticket);
            }
            
            return $tickets;
        }

        function getDepartments($db){
            $stmt = $db->prepare(
            'SELECT idDepartment
            FROM departmentUser
            WHERE idAgent = ?'
            );
            $stmt->execute([$this->id]);
            $departmentsRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $departments = [];

            foreach ($departmentsRows as $row) {
                array_push($departments, $row['idDepartment']);
            }

            return $departments;
        }

        function checkDepartment($db, $department){
            $stmt = $db->prepare('
                Select idDepartment from departmentuser where idAgent = ? and iddepartment = ?');
            $stmt->execute([$this->id, $department]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row == false) {
                return false;
            }
            return true;
        }
        
        function getTicketsWithDepartment($db, $department){
            $stmt = $db->prepare('SELECT idTicket, date, title, status, description, department, priority, idClient, idAgent, hashtag FROM tickets WHERE (idAgent = ?) AND department = ?');
            $stmt->execute([$this->id, $department]);
            $ticketRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $tickets = [];
            
            foreach ($ticketRows as $row) {
                $ticket = new Ticket(
                    intval($row['idTicket']),
                    $row['title'],
                    $row['status'],
                    $row['description'],
                    $row['department'],
                    $row['priority'],
                    strval($row['hashtag']),
                    $row['date'],
                    $row['idClient'],
                    intval($row['idAgent']),
                );
                
                array_push($tickets, $ticket);
            }
            
            return $tickets;
        }

        function getTicketsWithDepartmentNotAssigned($db, $department){
            $stmt = $db->prepare('SELECT idTicket, date,title, status,description, department, priority, idClient, idAgent, hashtag FROM tickets WHERE idAgent is null AND department = ?');
            $stmt->execute([$department]);
            $ticketRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $tickets = [];
            
            foreach ($ticketRows as $row) {
                $ticket = new Ticket(
                    intval($row['idTicket']),
                    $row['title'],
                    $row['status'],
                    $row['description'],
                    $row['department'],
                    $row['priority'],
                    strval($row['hashtag']),
                    $row['date'],
                    $row['idClient'],
                    intval($row['idAgent']),
                );
                
                array_push($tickets, $ticket);
            }
            
            return $tickets;
        }

        function getNumberTicketsByDepartment($db, $department){
            $tickets = $this->getTicketsWithDepartment($db, $department);
            return count($tickets);
        }

        function upgradeToAdmin($db){
            $stmt = $db->prepare(
                "DELETE FROM Agents WHERE idAgent = $this->id"
            );
            $stmt->execute();
            $stmt = $db->prepare(
                "DELETE FROM Clients WHERE idClient = $this->id"
            );
            $stmt->execute();
            $stmt = $db->prepare(
                "INSERT INTO Admins VALUES ($this->id)"
            );
            $stmt->execute();
        }

        function assignDepartment($db, $department){
            try{
            $stmt = $db->prepare(
                "Insert into departmentUser VALUES (?, ?)"
            );

            $stmt->execute([$department, $this->id]);
        } catch(PDOException $e) {

            }
        }
    }

?>