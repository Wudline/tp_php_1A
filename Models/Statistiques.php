<?php
    namespace Models;

    include ("Tools/Utils.php");
    use Tools\Utils as Utils;

    class Statistiques
    {
        /**
         * CptCroissantage
         * retourne le nombre de croissantage effectué par une personne
         * 
         * @param $id
         */

        public function CptCroissantage($db, $id)
        {
            $msg = "";
            $tool = new Utils();
            $requete = "select count($id) from croissantage where croissanteur=$id";
            return $tool->ResultRequest($db, $requete, $msg, $msg);
        }
    
        
        /**
         * CptCroissanté
         * retourne le nombre de fois qu'une personne s'est faite croissanter
         * 
         * @param $id
         */

        public function CptCroissanté($db, $id)
        {
            $msg = "";
            $tool = new Utils();
            $requete = "select count($id) from croissantage where croissante=$id";
            return $tool->ResultRequest($db, $requete, $msg, $msg);
        }
    
        
        /**
         * MeilleurCroissanteur
         * retourne le nom, la classe et la promotion du meilleur croissanteur 
         * c'est à dire, la personne ayant effectué le plus de croissantage
         */

        public function MeilleurCroissanteur($db)
        {
            $msg = "";
            $tool = new Utils();
            $requete = "select etudiant.nom, classe.nom, promo.annee, role.nom
                        from etudiant, classe, promo, role 
                        where etudiant.id=( 
                            select max(croissanteur) 
                            from croissantage 
                            group by croissanteur 
                            order by croissanteur 
                            desc limit 1 
                        ) 
                        and etudiant.classe=classe.id 
                        and etudiant.promo=promo.id
                        and etudiant.role=role.id;";
            return $tool->ResultRequest($db, $requete, $msg, $msg);
        }
    }

?>
