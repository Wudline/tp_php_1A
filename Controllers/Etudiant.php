<?php
    namespace Controllers;

    include("Models/Etudiant.php");

    use Models\Database;
    use Models\Statistiques as ModStats;
    use Models\Etudiant as Etudiant;

    final class CntrlEtudiant
    {
        /**
         * verifAjoutEtudiant
         * verifie les paramètres saisis
         * appelle la fonction d'insertion du modele Etudiant
         *
         * @param $login
         * @param $nom
         * @param $mdp
         * @param $viennoiserie
         * @param $classe
         * @param $promo
         * @param $role
         *
         * @return string
         */
        function verifAjoutEtudiant($login, $nom, $mdp, $classe, $promo, $role)
        {
            $ModEtu = new Etudiant();
            $database = new Database();
            $db = $database->getConnection();

            if((isset($login) && empty($login))
            || (isset($nom) && empty($nom))
            || (isset($mdp) && empty($mdp))
            || (isset($classe) && empty($classe))
            || (isset($promo) && empty($promo))
            || (isset($role) && empty($role))
            ){
                $msg = "Valeurs incorrectes ou vides";
            }
            else {

                $matchLog = preg_match('([A-Za-z]{1,10}.[A-Za-z]{1,10}[0-9]?)', $login);
                $matchAli = preg_match('([A-Za-z ]{3,50})', $nom);
                $matchmdp = preg_match('([0-9A-Za-z?./!*$@&]{3,10})', $mdp);
                $matchCla = preg_match('([0-9]+)', $classe);
                $matchDrt = preg_match('([0-9]+)', $role);
                $matchYea = preg_match('([0-9]+)', $promo);
                // $matchYea = preg_match('((19|20)[0-9]{2})', $promo);

                $login = "'".addslashes($login)."'";
                $mdp = "'".addslashes($mdp)."'";
                $nom = "'".addslashes($nom)."'";


                if( $matchLog && $matchAli && $matchmdp && $matchCla && $matchYea && $matchDrt ){
                    $ModEtu->AjouterEtudiant($db, $login, $nom, $mdp, $classe, $promo, $role);
                    $msg = "Un nouvel étudiant a été ajouté";
                }
                else {
                    $msg = "Valeurs renseignées incorrectes";
                }
            }
            return $msg;
        }

        /**
         * verifModifEtudiant
         * verifie les paramètres saisis
         * appelle la fonction d'update du modele Etudiant
         *
         * @param $id
         * @param $mdp
         * @param $classe
         * @param $role
         *
         * @return void
         */
        function verifModifEtudiant($id, $mdp, $classe, $role)
        {
            if( isset($id) && !empty($id) )
            {        
                if( isset($mdp) && !empty($mdp) )
                {
                    $this->verifModifMdpEtudiant($id, $mdp);
                }

                if( isset($classe) && !empty($classe) )
                {
                    $this->verifModifClasseEtudiant($id, $classe);
                }

                if( isset($role) && !empty($role) )
                {
                    $this->verifModifDroitsEtudiant($id, $role);
                }
            }
        }

        /**
         * verifModifClasseEtudiant
         * verifie les paramètres saisis
         * appelle la fonction d'update du modele Etudiant
         *
         * @param $idStudent
         * @param $classe
         *
         * @return string
         */
        function verifModifClasseEtudiant($idStudent, $classe)
        {
            $ModEtu = new Etudiant();
            $database = new Database();
            $db = $database->getConnection();

            if((isset($idStudent) && empty($idStudent)) || (isset($classe) && empty($classe)) )
            {
                $msg = "Valeurs incorrectes ou non renseignées";
            }
            else {

                $matchIdS = preg_match('([0-9]+)', $idStudent);
                $matchClasse = preg_match('([0-9]+)', $classe);

                if( $matchIdS && $matchClasse ){
                    $ModEtu->ModifierClasseEtudiant($db, $idStudent, $classe);
                    $nom = $ModEtu->getNom($db, $idStudent, "etudiant");
                    $msg = "$nom a été changé(e) de classe";
                }
                else {
                    $msg = "Valeurs renseignées incorrectes";
                }
            }

            return $msg;
        }

        /**
         * verifModifMdpEtudiant
         * verifie les paramètres saisis
         * appelle la fonction d'update du modele Etudiant
         *
         * @param $db
         * @param $idStudent
         * @param $mdp
         *
         * @return string
         */
        function verifModifMdpEtudiant($idStudent, $mdp)
        {
            $ModEtu = new Etudiant();
            $database = new Database();
            $db = $database->getConnection();


            if((isset($idStudent) && empty($idStudent)) || (isset($mdp) && empty($mdp)) )
            {
                $msg = "Valeurs incorrectes ou non renseignées";
            }
            else {

                $matchIdS = preg_match('([0-9]+)', $idStudent);
                $matchmdp = preg_match('([0-9A-Za-z?./!*$@&]{3,10})', $mdp);

                if( $matchIdS && $matchmdp ){
                    $ModEtu->ModifierMdpEtudiant($db, $idStudent, $mdp);
                    $nom = $ModEtu->getNom($db, $idStudent, "etudiant");
                    $msg = "Le mot de passe de $nom a été modifié";            
                }
                else {
                    $msg = "Valeurs renseignées incorrectes";
                }
            }
            return $msg;
        }

        /**
         * verifModifMdpEtudiant
         * verifie les paramètres saisis
         * appelle la fonction d'update du modele Etudiant
         *
         * @param $db
         * @param $idStudent
         * @param $role
         *
         * @return string
         */
        function verifModifDroitsEtudiant($idStudent, $role)
        {
            $ModEtu = new Etudiant();
            $database = new Database();
            $db = $database->getConnection();

            if( (isset($idStudent) && empty($idStudent)) || (isset($role) && empty($role)) )
            {
                $msg = "Valeurs incorrectes ou non renseignées";
            }
            else {

                $matchId = preg_match('([0-9]+)', $idStudent);
                $matchDroits = preg_match('([0-9]+)', $role);

                if( $matchId && $matchDroits ){
                    $ModEtu->ModifierDroitsEtudiant($db, $idStudent, $role);
                    $nom = $ModEtu->getNom($db, $idStudent,"etudiant");
                    $msg = "Les droits de $nom ont été modifiés";
                }
                else {
                    $msg = "Valeurs renseignées incorrectes";
                }
            }

            return $msg;
        }

        /**
         * SelectEtudiants
         * affiche un select
         *
         * @param $nomPost
         * @param $classe
         * @param $promo
         *
         * @return void
         */
        function SelectEtudiants($nomPost, $classe, $promo)
        {
            $ModEtu = new Etudiant();
            $database = new Database();
            $db = $database->getConnection();

            $liste = $ModEtu->ListeEtudiants($db, $classe, $promo);

            echo "<select name='$nomPost'>";

            foreach($liste as $ModEtu)
            {
                echo "<option value='".$ModEtu['id']."'>".$ModEtu['nom']."</option>";
            }
            
            echo "</select>";
        }

        /**
         * SelectRole
         * affiche un select
         *
         * @param $nomPost
         *
         * @return void
         */

        function SelectRole($nomPost)
        {
            $ModEtu = new Etudiant();
            $database = new Database();
            $db = $database->getConnection();

            $liste = $ModEtu->ListeRoles($db);

            echo "<select name='$nomPost'>";

            foreach($liste as $role)
            {
                echo "<option value='".$role['id']."'>".$role['nom']."</option>";
            }

            echo "</select>";
        }

        /**
         * AfficheEtudiants
         * affiche un tableau référençant les étudiants d'une classe / promo
         *
         * @param $classe
         * @param $promo
         *
         * @return void
         */
        function AfficheEtudiants($classe, $promo)
        {
            $ModStat = new ModStats();
            $ModEtu = new Etudiant();
            $database = new Database();
            $db = $database->getConnection();

            $liste = $ModEtu->ListeEtudiants($db, $classe, $promo);

            echo "<table>";
            echo "<tr>";
            echo "<td style='text-align: center'>login</td>";
            echo "<td style='text-align: center'>nom</td>";
            echo "<td style='text-align: center'>classe</td>";
            echo "<td style='text-align: center'>promo</td>";
            echo "<td style='text-align: center'>role</td>";
            echo "<td style='text-align: center'>Croissantages</td>";
            echo "<td style='text-align: center'>Croissanté</td>";
            echo "</tr>";

            foreach($liste as $etu)
            {
                $nbrCroissantage = $ModStat->CptCroissantage($db, $etu['id']);
                $nFoisCroissanté = $ModStat->CptCroissanté($db, $etu['id']);

                echo "<tr>";

                echo "<td>".$etu['login']."</td>";
                echo "<td>".$etu['nom']."</td>";
                echo "<td style='text-align: center'>".$ModEtu->getNom($db, $etu['classe'], "classe")."</td>";
                echo "<td style='text-align: center'>".$ModEtu->getPromo($db, $etu['promo'])."</td>";
                echo "<td style='text-align: center'>".$ModEtu->getNom($db, $etu['role'], "role")."</td>";
                echo "<td style='text-align: center'>".$nbrCroissantage[0][0]."</td>";
                echo "<td style='text-align: center'>".$nFoisCroissanté[0][0]."</td>";

                echo "</tr>";
            }
            echo "</table>";
        }
    }    

?>