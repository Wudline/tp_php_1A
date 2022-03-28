<?php
    namespace Models;

    class Classe {
            
            
        /**
         * ListeClasse
         * retourne l'ensemble des classes référencées
         * 
         * @return $rslt
         */

        public function ListeClasse($classe, $promo)
        {
            $requete = "select etudiant.nom, classe.nom, promo.annee
                        from promo, etudiant, classe
                        where etudiant.classe=classe.id
                        and classe.nom=$classe
                        and promo.annee=$promo
                        order by etudiant.nom;";
            $stmt = $db->prepare($requete);
            $exec = $stmt->execute();
            $cmpt = $stmt->rowCount();
            $rslt = $stmt->fetchAll();
            
            return $rslt;
        }
    }

?>
