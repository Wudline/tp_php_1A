<?php
    namespace Controllers;

    include("Models/Classe.php");
    use Models\Classe;
    use Models\Database;

    final class CntrlClasse
    {

        /**
         * Affiche les étudiants associés à une classe pour une année donnée
         * fait appel au modele Classe pour sa fonction "ListeEtudiant"
         * 
         * @see ListeEtudiant($classe, $promo)
         * @param $classe,
         * @param $promo
         */

        function AfficheClasse($classe, $promo)
        {
            $cl = new Classe();
            $database = new Database();
            $db = $database->getConnection();

            $liste = $cl->ListeClasse($db, $classe, $promo);
    
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
         * Permet de sélectionner une classe parmis celle renseignée en base de données
         */

        function SelectClasses($nomPost)
        {
            $ModClas = new Classe();
            $database = new Database();
            $db = $database->getConnection();

            $liste = $ModClas->ListeClasse($db);

            echo "<select name='$nomPost'>";

            foreach($liste as $classe)
            {
                echo "<option value='".$classe['id']."'>".$classe['nom']."</option>";
            }

            echo "</select>";
        }
    }

?>