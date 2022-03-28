<?php
    namespace Models;

    class Promo {
    
        
        /**
         * ListePromo
         * retourne la liste des etudiants, avec leur classe, d'une promo
         * 
         * @return $rslt
         */

        public function ListePromo()
        {
            $requete = "select etudiant.nom, classe.nom, promo.annee
                        from promo, etudiant, classe
                        where etudiant.classe=classe.id
                        order by promo.annee, etudiant.classe, etudiant.nom ";
            $stmt = $db->prepare($requete);
            $exec = $stmt->execute();
            $cmpt = $stmt->rowCount();
            $rslt = $stmt->fetchAll();
            
            return $rslt;
        }
    }

?>
