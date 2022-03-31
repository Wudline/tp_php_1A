<?php

    namespace Tools;

    class Session {

        function test(){
            session_name("SessionCroissantage");
            session_start();

            if ( !isset($_SESSION) )
            {
                $_SESSION["form_error"] = "Merci de vous connectez";
                header("Location: /");
                exit;
            }
            else
            {
                $url = $_SERVER['REQUEST_URI'];
                if ( $_SESSION['role'] == "1" )
                {
                    $page = "/Admin.php";

                    if ( $url != $page )
                    {
                        header("Location: $page");
                        exit;
                    }
                }
                else
                {
                    $page = "/Etudiant.php";

                    if ( $url != $page )
                    {
                        header("Location: $page");
                        exit;
                    }
                }
            }

        }

    }

?>