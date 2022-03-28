<?php
    namespace Models;

    class Statistiques {
    
        
        /**
         * CptCroissantage
         * retourne le nombre de croissantage effectué par une personne
         * 
         * @param $id
         * @return $rslt
         */

        public function CptCroissantage($id)
        {
            $requete = "select count($id) from croissantage where croissanteur=$id";
            
            $stmt = $db->prepare($requete);
            $exec = $stmt->execute();
            $cmpt = $stmt->rowCount();
            $rslt = $stmt->fetchAll();  
            
            return $rslt[0];
        }
    
        
        /**
         * CptCroissanté
         * retourne le nombre de fois qu'une personne s'est faite croissanter
         * 
         * @param $id
         * @return $rslt
         */

        public function CptCroissanté($id)
        {
            $requete = "select count($id) from croissantage where croissante=$id";
            
            $stmt = $db->prepare($requete);
            $exec = $stmt->execute();
            $cmpt = $stmt->rowCount();
            $rslt = $stmt->fetchAll();  
            
            return $rslt[0];
        }
    
        
        /**
         * MeilleurCroissanteur
         * retourne le nom, la classe et la promotion du meilleur croissanteur 
         * c'est à dire, la personne ayant effectué le plus de croissantage
         * 
         * @return $rslt
         */

        public function MeilleurCroissanteur()
        {
            $requete = "select etudiant.nom, classe.nom, promo.annee
                        from etudiant, classe, promo 
                        where etudiant.id=( select max(croissanteur) from croissantage group by croissanteur order by croissanteur desc limit 1 ) 
                        and etudiant.classe=classe.id
                        and etudiant.promo=promo.id;";
            
            $stmt = $db->prepare($requete);
            $exec = $stmt->execute();
            $cmpt = $stmt->rowCount();
            $rslt = $stmt->fetchAll();  
            
            return $rslt;
        }
    }

?>
