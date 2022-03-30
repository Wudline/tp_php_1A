<?php
    namespace Controllers;

    include("Models/Database.php");

    use Models\Database;
    use Models\Statistiques as Statistiques;

    final class CntrlStatistiques
    {
        function ShowMeilleurCroissanteur(){
            $ModStat = new Statistiques();
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
    }

?>