<?php
    namespace Models;

    use PDO;
    use PDOException;

    class Database {
        
        private $host = "localhost";
        private $db_name = "croissant";        
        private $username = "croissant";        
        private $password = "croissant";  

        public $conn;

        public function getConnection()
        { 
            $this->conn = null;

            try
            {
                $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name.";charset=UTF8;", $this->username, $this->password);          
               
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);        
                // $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

                // echo "connexion à la bdd réussie";
            }                        
            catch(PDOException $exception)
            {
                echo "Erreur de connexion à la base de données : ".$exception->getMessage();
                die();
            }

            return $this->conn;
        }
    }

?>
