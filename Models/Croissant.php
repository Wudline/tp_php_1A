<?php
    namespace Models;

    use Tools\Utils as Utils;

    class Croissant {
    
        /**
         * NouveauCroissantage
         * insertion en base d'un nouveau croissantage
         * 
         * @param $idCer,
         * @param $idCed,
         * @param $dateC,
         * @param $deadline
         */

        public function AjoutCroissantage($db, $idCer, $idCed, $dateC, $deadline)
        {
            $requete = "insert into croissantage values (DEFAULT, $idCer, $idCed, $dateC, $deadline)";
            $db->query($requete);
        }
        
            
        /**
         * ListeCroissantage
         * retourne la liste de tous les croissantages
         */

        public function ListeCroissantage($db)
        {
            $msg = "";
            $tool = new Utils();
            $requete = "select * from croissantage order by dateCroissantage desc";
            return $tool->ResultRequest($db, $requete, $msg, $msg);
        }

        
        /**
         * ListeViennoiseries
         * retourne la liste de toutes les viennoiseries
         */

        public function ListerViennoiseries($db)
        {
            $msg = "";
            $tool = new Utils();
            $requete = "select * from viennoiserie;";
            return $tool->ResultRequest($db, $requete, $msg, $msg);
        }
    }

?>
