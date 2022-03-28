<?php

    namespace Models;

    include("Models/Database.php");
    
    class Connexion
    {

        /**
         * testCo
         * Vérifie si le login saisi existe en base
         * Si le login existe, vérification du mdp
         * Si le mdp correspond : connexion
         * 
         * @param $login, $mdp
         * 
         */

        function testCo($login, $mdp)
        {
            $database = new Database(); 
            $db = $database->getConnection();    

            if( !empty($login) )
            {
                $requete = "select login from etudiant where login='".addslashes($login)."';";
                // echo $requete;

                $stmt = $db->prepare($requete); 
                $exec = $stmt->execute();
                $cmpt = $stmt->rowCount();

                if( $exec )
                {
                    if( $cmpt>0 )
                    {
                        if( !empty($mdp) )
                        {
                            $req = "select mdp from etudiant where login='".addslashes($login)."';";
                            $stm = $db->prepare($req);
                            $exe = $stm->execute();
                            $cpt = $stm->rowCount();
                            $res = $stm->fetchAll();  
        
                            if( $mdp == $res )
                            {
                                session_name('CroissantageParty');
                                session_start();
        
                                $_SESSION['login'] = $login;
        
                                header('Location: ../Co.php');
                                exit;
                            }
                        }
                    } 
                    else 
                    {
                        echo "$login inexistant en base";
                    }
                }
                else 
                {
                    echo "echec de la requete";
                }
            }
        }
        
    }
?>