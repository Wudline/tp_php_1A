<?php

    namespace Models;

    include("Models/Database.php");
    include("Tools/Utils.php");

    use Tools\Utils;

    class Connexion
    {
        /**
         * testCo
         * Vérifie si le login saisi existe en base
         * Si le login existe, vérification du mdp
         * Si le mdp correspond : connexion
         *
         * @param $login,
         * @param $mdp
         *
         */

        function testCo($login, $mdp)
        {
            $database = new Database();
            $db = $database->getConnection();

            $tool = new Utils();

            if( !empty($login) )
            {
                $msgNullCmpt = "$login inexistant en base<br>";
                $msgNullExec = "echec de la requete<br>";

                $requete = "select login from etudiant where login='".addslashes($login)."';";
                $rslt = $tool->ResultRequest($db, $requete, $msgNullCmpt, $msgNullExec);

                if( !empty($rslt) )
                {
                    if( !empty($mdp) )
                    {
                        $req = "select mdp from etudiant where login='".addslashes($login)."';";
                        $res = $tool->ResultRequest($db, $req, $msgNullCmpt, $msgNullExec);

                        if( $mdp == $res[0]['mdp'] )
                        {
                            $rq = "select etudiant.id as id, etudiant.nom, role.nom as role, classe.nom as classe, promo.annee 
                                   from etudiant, role, classe, promo 
                                   where etudiant.login='".addslashes($login)."' 
                                   and role.id=etudiant.role
                                   and classe.id=etudiant.classe
                                   and promo.id=etudiant.promo;";
                            $rs = $tool->ResultRequest($db, $rq, $msgNullCmpt, $msgNullExec);

                            $_SESSION['idlog'] = $rs[0]["id"];
                            $_SESSION['login'] = $login;
                            $_SESSION['nom'] = $rs[0]["nom"];
                            $_SESSION['role'] = $rs[0]["role"];
                            $_SESSION['classe'] = $rs[0]["classe"];
                            $_SESSION['promo'] = $rs[0]["annee"];

                            // header('Location: Co.php');
                            // exit;
                        }
                        else
                        {
                            echo "mot de passe incorrect<br>";
                        }
                    }
                }
            }
        }
    }
?>