<?php
    namespace Models;

    class Commande {

                
            
        /**
         * NouvelleCommande
         * insert en base une nouvelle commande
         * 
         * @param $croissantage, $dateCroissantage
         * @return $rslt
         */

        public function NouvelleCommande($croissantage, $dateCroissantage)
        {
            $requete = "insert into commande (croissanteur,	croissante,	dateCroissantage, deadline) 
                        values (DEFAULT, $idCer, $idCed, $dateC, $deadline)";
            $insert = $db->query($requete);
        }
        
            
        /**
         * ListeCommande
         * retourne la liste de toutes les commandes
         * 
         * @return $rslt
         */

        public function ListeCommande()
        {
            $requete = "select * from commande order by dateCommande desc";
            $stmt = $db->prepare($requete);
            $exec = $stmt->execute();
            $cmpt = $stmt->rowCount();
            $rslt = $stmt->fetchAll();  
            
            return $rslt;
        }
    }

?>
