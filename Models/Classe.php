<?php
    namespace Models;

    use Tools\Utils;

class Classe {
            
            
        /**
         * ListeClasse
         * retourne l'ensemble des classes référencées
         */

        public function ListeClasse($db)
        {
            $msg = "";
            $tool = new Utils();
            $requete = "select * from classe;";
            return $tool->ResultRequest($db, $requete, $msg, $msg);
        }

        /**
         * ListeEtuClasse
         * retourne l'ensemble des étudiants pour une classe et une promo données
         */

        public function ListeEtuClasse($db, $classe, $promo)
        {
            $msg = "";
            $tool = new Utils();
            $requete = "select etudiant.nom, classe.nom, promo.annee
                            from promo, etudiant, classe
                            where etudiant.classe=classe.id
                            and classe.nom=$classe
                            and promo.annee=$promo
                            order by etudiant.nom;";
            return $tool->ResultRequest($db, $requete, $msg, $msg);
        }
    }

?>
