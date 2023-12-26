<?php 

class Session{
    private array $messages;
    public function __construct() {
        session_start();
        $this->messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
        unset($_SESSION['messages']);
      }
    
      public function isLoggedIn() : bool {
        return isset($_SESSION['id']);    
      }

      public function logout() {
        session_destroy();
      }
  
      public function getID() : ?int {
        return isset($_SESSION['id']) ? $_SESSION['id'] : null;    
      }

      public function setID(int $id){
        $_SESSION['id'] = $id;
      }

      public function setName(String $name){
        $_SESSION['name'] = $name;
      }
      
      public function addMessage(string $type, string $text) {
        $_SESSION['messages'][] = array('type' => $type, 'text' => $text);
      }
}
?>