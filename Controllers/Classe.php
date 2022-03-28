<?php
    namespace Controllers;

    include("../Models/Classe.php");
    $cl = new Models\Classe();

    final class CntrlClasse
    {

        /**
         * Affiche les étudiants associés à une classe pour une année donnée
         * fait appel au modele Classe pour sa fonction "ListeEtudiant"
         * 
         * @see ListeEtudiant($classe, $promo)
         * @param $classe, $promo
         */

        function AfficheClasse($classe, $promo)
        {
            $liste = $cl->ListeClasse($classe, $promo);
    
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