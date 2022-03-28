<?php
    namespace Models;

    class Etudiant {
    
        private $login;
        private $nom;
        private $msp;
        private $viennoiserie;
        private $classee;
        private $promo;

        
        /**
         * AjouterEtudiant
         * insertion en base d'un nouvel étudiant
         * 
         * @return $rslt
         */

        public function AjouterEtudiant($login, $nom, $mdp, $viennoiserie, $classe, $promo, $droit)
        {
            $requete = "insert into etudiant values (DEFAULT, $login, $nom, $mdp, $viennoiserie, $droit)";
            $insert = $db->query($requete);            

            $requete = "insert into Promo values (DEFAULT, $promo, $classe, $id)";
            $insert = $db->query($requete);
        }

        
        /**
         * ModifierClasseEtudiant
         * modification de la classe d'un étudiant en base
         * 
         * @return $rslt
         */

        public function ModifierClasseEtudiant($id, $classe)
        {
            $requete = "update etudiant set lasse='".addslashes($classe)."' where id=$id;";
            $update = $db->query($requete);
        }

        
        /**
         * ModifierMdpEtudiant
         * modification du mdp d'un étudiant en base
         * 
         * @return $rslt
         */

        public function ModifierMdpEtudiant($id, $mdp)
        {
            $requete = "update etudiant set mdp='".addslashes($mdp)."' where id=$id;";
            $update = $db->query($requete);
        }

        
        /**
         * ModifierDroitsEtudiant
         * modification des droits d'un étudiant en base
         * 
         * @return $rslt
         */

        public function ModifierDroitsEtudiant($id, $droit)
        {
            $requete = "update etudiant set droits='".addslashes($droit)."' where id=$id;";
            $update = $db->query($requete);
        }

        
        /**
         * ListeEtudiant
         * retourne la liste de tous les etudiants d'une classe et d'une promo donnée
         * si les parametre sont vide, retourne l'ensemble des étudiants référencés
         * 
         * @param $classe, $promo
         * @return $rslt
         */

        public function ListeEtudiant($classe, $promo)
        {
            $requete = "select * from etudiant where id not null "; 

            if( !empty($classe) )
            {
                $requete .= "and classe='$classe' ";
            }

            if( !empty($promo) )
            {
                $requete .= "and promo='$promo' ";
            }
            
            $requete .= "order by nom, classe, promo";
            
            $stmt = $db->prepare($requete);
            $exec = $stmt->execute();
            $cmpt = $stmt->rowCount();
            $rslt = $stmt->fetchAll();  
            
            return $rslt;
        }
    }

?>
