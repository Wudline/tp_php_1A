<?php
    namespace Controllers;

    include ("Models/Statistiques.php");
    use Models\Database;
    use Models\Statistiques as ModStats;
    use Tools\Utils;

    final class CntrlStatistiques
    {

        /**
         * ShowMeilleurCroissanteur
         *
         * @see MeilleurCroissanteur
         * @return void
         */
        function ShowMeilleurCroissanteur(){
            $ModStat = new ModStats();
            $database = new Database();
            $db = $database->getConnection();

            $data = $ModStat->MeilleurCroissanteur($db);
            echo "<table>";
                echo "<tr>";
                    echo "<td>Nom : ".$data[0][0]."</td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td>Classe : ".$data[0][1]."</td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td>Promo : ".$data[0][2]."</td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td>Rôle : ".$data[0][3]."</td>";
                echo "</tr>";
            echo "</table>";
        }

        /**
         * AfficheNbFoisCroissanté
         *
         * @see CptCroissanté
         * @return void
         */
        function AfficheNbFoisCroissanté()
        {
            $database = new Database();
            $ModStat = new ModStats();
            $tool = new Utils();

            $db = $database->getConnection();
            $msg = "error";

            $req = "select id from etudiant where login='".addslashes($_SESSION['login'])."'";
            $res = $tool->ResultRequest($db, $req, $msg, $msg);
            $tabRes = $ModStat->CptCroissanté($db, $res[0]['id']);
            echo $tabRes[0][0];
        }

        /**
         * AfficheNbCroissantage
         *
         * @see CptCroissantage
         * @return void
         */
        function AfficheNbCroissantage()
        {
            $database = new Database();
            $ModStat = new ModStats();
            $tool = new Utils();

            $db = $database->getConnection();
            $msg = "error";

            $req = "select id from etudiant where login='".addslashes($_SESSION['login'])."'";
            $res = $tool->ResultRequest($db, $req, $msg, $msg);
            $tabRes = $ModStat->CptCroissantage($db, $res[0]['id']);
            echo $tabRes[0][0];
        }
    }

?>