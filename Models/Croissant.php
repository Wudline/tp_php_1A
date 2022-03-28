<?php
    namespace Models;

    class Croissant {
    
        /**
         * NouveauCroissantage
         * insertion en base d'un nouveau croissantage
         * 
         * @param $idCer, $idCed, $dateC, $deadline
         */

        public function NouveauCroissantage($idCer, $idCed, $dateC, $deadline)
        {
            $requete = "insert into croissantage (croissanteur,	croissante,	dateCroissantage, deadline) 
                        values (DEFAULT, $idCer, $idCed, $dateC, $deadline)";
            $insert = $db->query($requete);
        }
        
            
        /**
         * ListeCroissantage
         * retourne la liste de tous les croissantages
         * 
         * @return $rslt
         */

        public function ListeCroissantage()
        {
            $requete = "select * from croissantage order by dateCroissantage desc";
            $stmt = $db->prepare($requete);
            $exec = $stmt->execute();
            $cmpt = $stmt->rowCount();
            $rslt = $stmt->fetchAll();  
            
            return $rslt;
        }

        
        /**
         * ListeViennoiseries
         * retourne la liste de toutes les viennoiseries
         * 
         * @return $rslt
         */

        public function ListeViennoiserie()
        {
            $requete = "select * from viennoiserie;";
            $stmt = $db->prepare($requete);
            $exec = $stmt->execute();
            $cmpt = $stmt->rowCount();
            $rslt = $stmt->fetchAll();  
            
            return $rslt;
        }
    }

?>
