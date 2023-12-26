<?php
     declare(strict_types = 1); 
     require_once('change.class.php');

     class Ticket{
        public int $idTicket;
        public string $title;
        public string $status;
        public string $priority;
        public string $description;
        public string $idClient;
        public int $idAgent;
        public string $department;
        public string $date;
        public string $hashtag;

        public function __construct(int $idTicket, string $title, string $status,
          string $description, string $department, string $priority, string $hashtag, string $date, string $idClient, int $idAgent){
            
            $this->idTicket = $idTicket;
            $this->title = $title;
            $this->status = $status;
            $this->description = $description;
            $this->department = $department;
            $this->priority = $priority;
            $this->hashtag = $hashtag;
            $this->date = $date;
            $this->idClient = $idClient;
            $this->idAgent = $idAgent;
        }


        public function getChanges($db){
            $stmt = $db->prepare("
            Select * from changes c join hashtagchanges h on c.idChange = h.idChange
            where c.idTicket = ?"
            );
            $stmt->execute([$this->idTicket]);
            
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $changes = [];

            foreach ($rows as $row) {
                $change = new HashTagChange(
                    $row['idChange'],
                    $row['date'],
                    $row['idTicket'],
                    $row['oldHashtag'],
                );
                
                array_push($changes, $change);
            }

            $stmt = $db->prepare("
            Select * from changes c join descriptionchange h on c.idChange = h.idChange
            where c.idTicket = ?"
            );
            $stmt->execute([$this->idTicket]);
            
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $row) {
                $change = new DescriptionChange(
                    $row['idChange'],
                    $row['date'],
                    $row['idTicket'],
                    $row['oldDescription'],
                );
                
                array_push($changes, $change);
            }

            $stmt = $db->prepare("
            Select * from changes c join DepartmentChange h on c.idChange = h.idChange
            where c.idTicket = ?"
            );
            $stmt->execute([$this->idTicket]);
            
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $row) {
                $change = new DepartmentChange(
                    $row['idChange'],
                    $row['date'],
                    $row['idTicket'],
                    $row['idOldDepartment'],
                );
                
                array_push($changes, $change);
            }

            $stmt = $db->prepare("
            Select * from  changes c join agentchange h on c.idChange = h.idChange
            where c.idTicket = ?"
            );
            $stmt->execute([$this->idTicket]);
            
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $row) {
                $change = new AgentChange(
                    $row['idChange'],
                    $row['date'],
                    $row['idTicket'],
                    $row['idOldAgent'],
                );
                
                array_push($changes, $change);
            }
            return $changes;
        }

        public function getStatus(){
            return $this->status;
        }
        
        public function getDepartment(){
            return $this->department;
        }
        public function getTitle(){
            return $this->title;
        }

        public function getPriority(){
            return $this->priority;
        }

       
        public function getInquiries($db){
            
            $stmt = $db->prepare("Select * from inquiries where idTicket = ?");

            $stmt->execute([$this->idTicket]);

            $inquiriesRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $inquiries = [];

            foreach ($inquiriesRows as $row) {
                $inquirie = new Inquirie(
                    $row['idInquirie'],
                    $row['content'],
                    $row['date'],
                    $row['idUser'],
                    $row['idTicket'],
                );
                
                array_push($inquiries, $inquirie);
            }

            return $inquiries;


        }

        public function changeDepartment($db, $newDepartment){

                $stmt = $db->prepare("INSERT INTO CHANGES (date, idTicket) VALUES
                    (:date, :idTicket)
                ");

                $today = date("Y-m-d");
                $stmt->bindParam(':date', $today);
                $stmt->bindParam(':idTicket', $this->idTicket);
                $stmt->execute();

                $idOld = $db->lastInsertId();

                $stmt = $db->prepare("
                INSERT INTO DepartmentChange VALUES
                (:idChange, :idOldDepartment)
                ");

                $stmt->bindParam(':idChange', $idOld);
                $stmt->bindParam(':idOldDepartment', $this->department);
                $stmt->execute();


                $stmt = $db->prepare("
                    UPDATE Tickets
                    SET department = :department
                    WHERE idTicket = :idTicket
                ");

                $stmt->bindParam(':department', $newDepartment);
                $stmt->bindParam(':idTicket', $this->idTicket);
                $stmt->execute();
        }

        public function updateHashtag(PDO $db, $idTicket, $newHashtags) {
            $stmt = $db->prepare("
                UPDATE Tickets
                SET hashtag = :newHashtags
                WHERE idTicket = :idTicket
            ");
            $stmt->bindParam(':newHashtags', $newHashtags);
            $stmt->bindParam(':idTicket', $idTicket);
            $stmt->execute();
        }
        
        function assignTicket(PDO $db, $id){

            $stmt = $db->prepare("
                INSERT INTO CHANGES (date, idTicket) VALUES
                (:date, :idTicket)
            ");
            $today = date("Y-m-d");
            $stmt->bindParam(':date', $today);
            $stmt->bindParam(':idTicket', $this->idTicket);
            $stmt->execute();

            $idOld = $db->lastInsertId();

            $stmt = $db->prepare("
                INSERT INTO AgentCHANGE VALUES
                (:idChange, :idOldAgent)
            ");

            $stmt->bindParam(':idChange', $idOld);
            $stmt->bindParam(':idOldAgent', $this->idAgent);

            $stmt->execute();

            $stmt = $db->prepare("
                    UPDATE Tickets
                    SET idAgent = :idAgent, status = \"Assigned\"
                    WHERE idTicket = :idTicket
            ");
            $stmt->bindParam(':idAgent', $id);
            $stmt->bindParam(':idTicket', $this->idTicket);
            $stmt->execute();
        }

        function updateStatus(PDO $db, $status){

            $stmt = $db->prepare("
                INSERT INTO CHANGES (date, idTicket) VALUES
                (:date, :idTicket)
            ");
            $today = date("Y-m-d");
            $stmt->bindParam(':date', $today);
            $stmt->bindParam(':idTicket', $this->idTicket);
            $stmt->execute();


            $stmt = $db->prepare("
                    UPDATE Tickets
                    SET status = :status
                    WHERE idTicket = :idTicket
            ");
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':idTicket', $this->idTicket);
            $stmt->execute();
        }


        static function addTicket(PDO $db, $title, $description, $user, $department ,$priority, $hashtag){
            $stmt = $db->prepare(
                "INSERT INTO TICKETS (title, description, status, idAgent, idClient, department, priority, hashtag, date)
                VALUES (:title, :description, 'Opened', NULL, :idClient, :department, :priority, :hashtag, :date)"
            );
            
            $currentDate = date('Y-m-d');
        
            $id = $user->getID();
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':idClient', $id);
            $stmt->bindParam(':department', $department);
            $stmt->bindParam(':priority', $priority);
            $stmt->bindParam(':hashtag', $hashtag);
            $stmt->bindParam(':date', $currentDate);
            $stmt->execute();
        }

    public function getidAgent(){
        return $this->idAgent;
    }

     

     public static function addInquirie(PDO $db, $inquirie){
        
        $stmt = $db->prepare(
            "INSERT INTO INQUIRIES (content, date, idUser, idTicket)
            VALUES (:content, :date, :idUser, :idTicket)"
        );

        $stmt->bindParam(':content', $inquirie->content);
        $stmt->bindParam(':date', $inquirie->date);
        $stmt->bindParam(':idUser', $inquirie->idUser);
        $stmt->bindParam(':idTicket', $inquirie->idTicket);
        $stmt->execute();
     }
    }

?>