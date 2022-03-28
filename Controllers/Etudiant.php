<?php
    namespace Controllers;

    include("../Models/Statistiques.php");
    $ModStat = new Models\Statistiques(); 

    include("../Models/Etudiant.php");
    $ModEtu = new Models\Etudiant(); 

    final class CntrlEtudiant
    {
        function verifAjoutEtudiant($login, $nom, $mdp, $viennoiserie, $classe, $promo)
        {
            if((isset($login) && empty($login))
            || (isset($nom) && empty($alia))
            || (isset($mdp) && empty($mdp))
            || (isset($viennoiserie) && empty($viennoiserie))
            || (isset($classe) && empty($classe))
            || (isset($promo) && empty($promo))
            ){
                $msg = "Valeurs incorrectes ou non renseignées";
            }
            else {

                $matchLog = preg_match('[A-Za-z]{1,10}.[A-Za-z]{1,10}[0-9]?', $login);
                $matchAli = preg_match('[A-Za-z ]{3,50}', $nom);
                $matchmdp = preg_match('[0-9A-Za-z?./!*$@&]{3,10}', $mdp);
                $matchMia = preg_match('[0-9]+', $viennoiserie);
                $matchCla = preg_match('[0-9]+', $classe);
                $matchYea = preg_match('(19||20)[0-9]{2}', $promo);

                if( $matchLog && $matchAli && $matchmdp && $matchMia && $matchCla && $matchYea ){
                    $ModEtu->AjoutEtudiant($login, $nom, $mdp, $viennoiserie, $classe, $promo);
                    $msg = "Un nouvel étudiant a été ajouté";
                }
                else {
                    $msg = "Valeurs renseignées incorrectes";
                }
            }

            return $msg;
        }

        function verifModifEtudiant($id, $mdp, $classe)
        {
            if( isset($id) && !empty($id) )
            {        
                if( isset($mdp) && !empty($mdp) )
                {
                    $ModEtu->verifModifMdpEtudiant($idStudent, $mdp);
                }

                if( isset($classe) && !empty($classe) )
                {
                    $ModEtu->verifModifClasseEtudiant($idStudent, $classe);
                }
            }
        }

        function verifModifClasseEtudiant($idStudent, $classe)
        {
            if((isset($idStudent) && empty($idStudent)) || (isset($classe) && empty($classe)) )
            {
                $msg = "Valeurs incorrectes ou non renseignées";
            }
            else {

                $matchIdS = preg_match('[0-9]+', $idStudent);
                $matchMia = preg_match('[0-9]+', $classe);

                if( $matchIdS && $matchClasse ){
                    $ModEtu->ModifierClasseEtudiant($idStudent, $classe);
                    $nom = getNom($idStudent);
                    $msg = "$nom a été changé(e) de classe";
                }
                else {
                    $msg = "Valeurs renseignées incorrectes";
                }
            }

            return $msg;
        }


        function verifModifMdpEtudiant($idStudent, $mdp)
        {
            if((isset($idStudent) && empty($idStudent)) || (isset($mdp) && empty($mdp)) )
            {
                $msg = "Valeurs incorrectes ou non renseignées";
            }
            else {

                $matchIdS = preg_match('[0-9]+', $idStudent);
                $matchmdp = preg_match('[0-9A-Za-z?./!*$@&]{3,10}', $mdp);

                if( $matchIdS && $matchmdp ){
                    $ModEtu->ModifierMdpEtudiant($idStudent, $mdp);
                    $nom = getNom($idStudent);
                    $msg = "Le mot de passe de $nom a été modifié";            
                }
                else {
                    $msg = "Valeurs renseignées incorrectes";
                }
            }

            return $msg;
        }

        function verifModifDroitsEtudiant($idStudent, $droits)
        {
            if( (isset($idStudent) && empty($idStudent)) || (isset($droits) && empty($droits)) )
            {
                $msg = "Valeurs incorrectes ou non renseignées";
            }
            else {

                $matchId = preg_match('[0-9]+', $idStudent);
                $matchDroits = preg_match('[0-9]+', $droits);

                if( $matchId && $matchDroits ){
                    $ModEtu->ModifierDroitsEtudiant($idStudent, $droits);
                    $nom = getNom($idStudent);
                    $msg = "Les droits de $nom ont été modifiés";
                }
                else {
                    $msg = "Valeurs renseignées incorrectes";
                }
            }

            return $msg;
        }

        function SelectEtudiants($nomPost, $classe, $promo)
        {
            $liste = $ModEtu->ListeEtudiants($classe, $promo);

            echo "<select name='$nomPost'>";

            foreach($liste as $ModEtu)
            {
                echo "<option value='".$ModEtu['id']."'>".$ModEtu['nom']."</option>";
            }
            
            echo "</select>";
        }

        function AfficheEtudiants($classe, $promo)
        {
            $liste = $ModEtu->ListeEtudiants($classe, $promo);

            echo "<table>";
            foreach($liste as $etu)
            {
                $nbrCroissantage = $ModStat->CptCroissantage($etu['id']);
                $nFoisCroissanté = $ModStat->CptCroissanté($etu['id']);

                echo "<tr>";

                echo "<td>".$etu['login']."</td>";
                echo "<td>".$etu['nom']."</td>";
                echo "<td>".$etu['classe']."</td>";
                echo "<td>".$etu['promo']."</td>";
                echo "<td>".$etu['viennoiserie']."</td>";
                echo "<td>".$nbrCroissantage."</td>";
                echo "<td>".$nFoisCroissanté."</td>";
                
                echo "</tr>";
            }
            echo "</table>";
        }
    }    

?>