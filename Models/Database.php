<?php
    namespace Models;

    class Database {
        
        private $host = "localhost:3306";        
        private $db_name = "croissant";        
        private $username = "croissant";        
        private $password = "croissant";  

        public $conn;

        public function getConnection()
        { 
            $this->conn = null;

           try
            {
                echo "pika~";

                $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name.";charset=UTF8;", $this->username, $this->password);
               
                echo "chu!";
               
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);        
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); 

                echo "connexion à la bdd réussie";
            }                        
            // catch(PDOException $exception)
            catch(\Exception $exception)
            {
                echo "Erreur de connexion à la base de données : ".$exception->getMessage();
                die();
            }

/*
            $this->conn = mysqli_connect($this->host, $this->username, $this->password);
            
            if (!$this->conn)
            {
                die("Connection failed: " . mysqli_connect_error());
            }
            
            echo "Connected successfully";
*/            
            
            return $this->conn;
        }
    }

?>
