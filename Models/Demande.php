<?php
    namespace Models;

    use Tools\Utils as Utils;

    class Demande
    {

        /**
         * NouvelleDemande
         * insertion en base d'une nouvelle demande
         *
         * @param $croissantage
         * @param $etudiant
         * @param $viennoiserie
         */

        public function AjoutDemande($db, $croissanté, $etudiant, $viennoiserie)
        {
            $msg = "";
            $tool = new Utils();

            $reqTmp = "select id from croissantage where croissante=$croissanté order by id desc limit 1";
            $res = $tool->ResultRequest($db, $reqTmp, $msg, $msg);
            $croissantage = $res[0]['id'];

            $requete = "insert into demande values (DEFAULT , $croissantage, $etudiant, $viennoiserie)";
            $db->query($requete);
        }


        /**
         * ListeDemande
         * retourne la liste de toutes les demandes
         */

        public function ListeDemande($db)
        {
            $msg = "";
            $tool = new Utils();
            $requete = "select * from demande order by croissantage desc";
            return $tool->ResultRequest($db, $requete, $msg, $msg);
        }
    }

?>
