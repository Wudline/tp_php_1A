<?php
    namespace Controllers;

    include("Models/Promo.php");

    use Models\Promo;
    use Models\Database;

    final class CntrlPromo
    {
        function AffichePromo()
        {
            $ModProm = new Promo();
            $database = new Database();
            $db = $database->getConnection();

            $liste = $ModProm->ListePromo($db);

            echo "<table>";
            foreach($liste as $etudiant)
            {
                echo "<tr>";

                echo "<td>".$etudiant[0]."</td>";
                echo "<td>".$etudiant[1]."</td>";
                echo "<td>".$etudiant[2]."</td>";
                
                echo "</tr>";
            }
            echo "</table>";
        }

        /**
         * Permet de sélectionner une promo parmis celle renseignée en base de données
         */

        function SelectPromo($nomPost)
        {
            $ModProm = new Promo();
            $database = new Database();
            $db = $database->getConnection();

            $liste = $ModProm->ListePromo($db);

            echo "<select name='$nomPost'>";

            foreach($liste as $promo)
            {
                echo "<option value='".$promo['id']."'>".$promo['annee']."</option>";
            }

            echo "</select>";
        }
    }

?>