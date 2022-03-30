<?php
    namespace Models;

    use Tools\Utils;

class Promo {
    
        
        /**
         * ListePromo
         * retourne la liste des etudiants, avec leur classe, d'une promo
         */

        public function ListePromo($db)
        {
            $tool = new Utils();
            $msg = "";

            $requete = "select * from promo order by annee desc;";
            return $tool->ResultRequest($db, $requete, $msg, $msg);
        }
    }

?>
