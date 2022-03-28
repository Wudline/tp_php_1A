<?php
    namespace Controllers;

    include("../Models/Croissant.php");
    $ModCroissant = new Models\Croissant();
    
    include("../Models/Demande.php");
    $ModDemande = new Models\Demande();

    final class CntrlCroissant
    {

        /**
         * NouveauCroissantage
         * Vérifie les données saisies
         * Créer une deadline de remboursement de dette de croissantage
         * 
         * Fait appel au modele Croissant pour sa fonction "AjoutCroissantage"
         * 
         * @see AjoutCroissantage($idCroissanteur, $idCroissanté, $dateCroissantage, $deadline)
         * @param $idCroissanteur, $idCroissanté, $dateCroissantage, $deadline
         */

        function NouveauCroissantage($idCroissanteur, $idCroissanté, $dateCroissantage)
        {
            $matchIdCr = preg_match('[0-9]+', $idCroissanteur);

            if( !empty($matchIdCr) )
            {
                $matchIdCd = preg_match('[0-9]+', $idCroissanté);

                if( !empty($matchIdCd) )
                {
                    $matchDate = preg_match('[0-9]{4}-[0-9]{2}-[0-9]{2}', $dateCroissantage);

                    if( !empty($matchDate) )
                    {
                        $deadline = $dateCroissantage->modify( '+1 week' ); 

                        $ModCroissant->AjoutCroissantage($idCroissanteur, $idCroissanté, $dateCroissantage, $deadline);
                    }
                    else 
                    {
                        echo "Date non conforme<br>";
                    }
                }
                else 
                {
                    echo "Croissanté non reconnu<br>";
                }
            }
            else 
            {
                echo "Croissanteur non reconnu<br>";
            }
        }



        /**
         * VoteCroissantage
         * Vérifie les données saisies
         * un étudiant renseigne la viennoiserie de son choix sur un croissantage
         * 
         * Fait appel au modele Croissant pour sa fonction "AjoutDemande"
         * 
         * @see AjoutDemande($croissantage, $etudiant, $viennoise)
         * @param $croissantage, $etudiant, $viennoise
         */

        function VoteCroissantage($croissantage, $etudiant, $viennoise)
        {
            $matchCroissantage = preg_match('[0-9]+', $croissantage);

            if( !empty($matchCroissantage) )
            {
                $matchEtudiant = preg_match('[0-9]+', $etudiant);

                if( !empty($matchEtudiant) )
                {
                    $matchViennoiserie = preg_match('[0-9]+', $viennoise);

                    if( !empty($matchViennoiserie) )
                    {
                        $ModDemande->AjoutDemande($croissantage, $etudiant, $viennoise);
                    }
                }
            }

        }

        function AfficheCroissant()
        {
            $liste = $ModCroissant->ListeCroissantage();

            echo "<table>";
            foreach($liste as $ModCroissantage)
            {
                echo "<tr>";

                echo "<td>".$ModCroissantage['croissanteur']."</td>";
                echo "<td>".$ModCroissantage['croissante']."</td>";
                echo "<td>".$ModCroissantage['dateCroissantage']."</td>";
                
                echo "</tr>";
            }
            echo "</table>";
        }

        function SelectViennoiseries($nomPost)
        {
            $liste = $ModCroissant->zListerViennoiseries();

            echo "<select name='$nomPost'>";

            foreach($liste as $viennoise)
            {
                echo "<option value='".$viennoise['id']."'>".$viennoise['nom']."</option>";
            }
            
            echo "</select>";
        }
    }
    
?>