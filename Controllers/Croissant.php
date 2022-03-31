<?php
    namespace Controllers;

    include ("Models/Croissant.php");
    include ("Models/Demande.php");
    
    use Models\Croissant as Croissant;
    use Models\Database;
    use Models\Demande;

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
            $ModCroissant = new Croissant();
            $database = new Database();
            $db = $database->getConnection();

            $matchIdCr = preg_match('([0-9]+)', $idCroissanteur);

            if( !empty($matchIdCr) )
            {
                $matchIdCd = preg_match('([0-9]+)', $idCroissanté);

                if( !empty($matchIdCd) )
                {
                    $matchDate = preg_match('([0-9]{4}-[0-9]{2}-[0-9]{2})', $dateCroissantage);

                    if( !empty($matchDate) )
                    {
                        $ArrayDate = getdate(strtotime($dateCroissantage));
                        $dateCroissantage = "'".$dateCroissantage."'";
                        $deadline = "'".date("Y-m-d", mktime(0, 0, 0, $ArrayDate['mon'], $ArrayDate['mday']+7, $ArrayDate['year']))."'";
                        $ModCroissant->AjoutCroissantage($db, $idCroissanteur, $idCroissanté, $dateCroissantage, $deadline);
                        $msg = "Nouveau croissantage enregistré !<br>";
                    }
                    else 
                    {
                        $msg = "Date non conforme<br>";
                    }
                }
                else 
                {
                    $msg = "Croissanté non reconnu<br>";
                }
            }
            else 
            {
                $msg = "Croissanteur non reconnu<br>";
            }
            return $msg;
        }



        /**
         * VoteCroissantage
         * Vérifie les données saisies
         * un étudiant renseigne la viennoiserie de son choix sur un croissantage
         * 
         * Fait appel au modele Croissant pour sa fonction "AjoutDemande"
         * 
         * @see AjoutDemande($croissantage, $etudiant, $viennoiserie)
         * @param $croissantage, $etudiant, $viennoiserie
         */

        function VoteCroissantage($croissanté, $etudiant, $viennoiserie)
        {
            $ModDemande = new Demande();
            $database = new Database();
            $db = $database->getConnection();

            $matchCroissantage = preg_match('([0-9]+)', $croissanté);

            if( !empty($matchCroissantage) )
            {
                $matchEtudiant = preg_match('([0-9]+)', $etudiant);

                if( !empty($matchEtudiant) )
                {
                    $matchViennoiserie = preg_match('([0-9]+)', $viennoiserie);

                    if( !empty($matchViennoiserie) )
                    {
                        $ModDemande->AjoutDemande($db, $croissanté, $etudiant, $viennoiserie);
                        $msg = "Une nouvelle demande de viennoiserie vient d'etre effectuée.<br>";
                    }
                    else
                    {
                        $msg = "Viennoiserie mal renseignée.<br>";
                    }
                }
                else
                {
                    $msg = "Etudiant effectuant la demande mal renseigné.<br>";
                }
            }
            else
            {
                $msg = "Etudiant croissanté mal renseigné.<br>";
            }
            return $msg;
        }

        function AfficheCroissant()
        {
            $ModCroissant = new Croissant();
            $database = new Database();
            $db = $database->getConnection();

            $liste = $ModCroissant->ListeCroissantage($db);

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

        /**
         * Permet de sélectionner une viennoiserie parmis celle renseignée en base de données
         */

        function SelectViennoiseries($nomPost)
        {
            $ModCroissant = new Croissant();
            $database = new Database();
            $db = $database->getConnection();

            $liste = $ModCroissant->ListerViennoiseries($db);

            echo "<select name='$nomPost'>";

            foreach($liste as $viennoiserie)
            {
                echo "<option value='".$viennoiserie['id']."'>".$viennoiserie['nom']."</option>";
            }
            
            echo "</select>";
        }
    }
    
?>