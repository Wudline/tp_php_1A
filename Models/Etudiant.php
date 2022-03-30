<?php
    namespace Models;

    use Tools\Utils as Utils;

    class Etudiant
    {
        /**
         * ModifierClasseEtudiant
         * modification de la classe d'un étudiant en bas
         */

        public function getNom($db, $id)
        {
            $msg = "";
            $tool = new Utils();

            $requete = "select nom from etudiant where id=$id;";
            return $tool->ResultRequest($db, $requete, $msg, $msg);
        }


        /**
         * AjouterEtudiant
         * insertion en base d'un nouvel étudiant
         * insertion dudit etudiant en promo
         */

        public function AjouterEtudiant($db, $login, $nom, $mdp, $classe, $promo, $droit)
        {
            $requete = "insert into etudiant values (DEFAULT, $login, $nom, $mdp, $classe, $promo, $droit)";
            $db->query($requete);
        }

        
        /**
         * ModifierClasseEtudiant
         * modification de la classe d'un étudiant en bas
         */

        public function ModifierClasseEtudiant($db, $id, $classe)
        {
            $requete = "update etudiant set classe='".addslashes($classe)."' where id=$id;";
            $db->query($requete);
        }

        
        /**
         * ModifierMdpEtudiant
         * modification du mdp d'un étudiant en base
         */

        public function ModifierMdpEtudiant($db, $id, $mdp)
        {
            $requete = "update etudiant set mdp='".addslashes($mdp)."' where id=$id;";
            $db->query($requete);
        }

        
        /**
         * ModifierDroitsEtudiant
         * modification des droits d'un étudiant en base
         */

        public function ModifierDroitsEtudiant($db, $id, $droit)
        {
            $requete = "update etudiant set role='".addslashes($droit)."' where id=$id;";
            $db->query($requete);
        }

        
        /**
         * ListeEtudiant
         * retourne la liste de tous les etudiants d'une classe et d'une promo donnée
         * si les parametre sont vide, retourne l'ensemble des étudiants référencés
         * 
         * @param $classe
         * @param $promo
         *
         */

        public function ListeEtudiants($db, $classe, $promo)
        {
            $msg = "";
            $tool = new Utils();

            $requete = "select * from etudiant where id!='NULL' ";

            if( !empty($classe) )
            {
                $reqTmp = "select id from classe where nom='".addslashes($classe)."'; ";
                $idClasse = $tool->ResultRequest($db, $reqTmp, $msg, $msg);

                $requete .= "and classe='".addslashes($idClasse[0]['id'])."' ";
            }

            if( !empty($promo) )
            {
                $reqTmp = "select id from promo where annee='".addslashes($promo)."'; ";
                $idPromo = $tool->ResultRequest($db, $reqTmp, $msg, $msg);

                $requete .= "and promo='".addslashes($idPromo[0]['id'])."' ";
            }
            
            $requete .= "order by nom, classe, promo";
            return $tool->ResultRequest($db, $requete, $msg, $msg);
        }


        /**
         * ListeRoles
         * retourne la liste de tous les roles référencés
         *
         */

        public function ListeRoles($db)
        {
            $msg = "";
            $tool = new Utils();
            $requete = "select * from role";
            return $tool->ResultRequest($db, $requete, $msg, $msg);
        }
    }

?>
