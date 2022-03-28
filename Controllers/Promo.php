<?php
    namespace Controllers;

    include("../Models/Promo.php");
    $ModProm = new Models\Promo();

    final class CntrlPromo
    {
        function AffichePromo()
        {
            $liste = $ModProm->ListePromo();

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
    }

?>