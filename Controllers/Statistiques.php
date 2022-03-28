<?php
    namespace Controllers;

    include("../Models/Statistiques.php");
    $ModStat = new Models\Statistiques();

    final class CntrlStatistiques
    {
        function ShowMeilleurCroissanteur(){
            $data = $ModStat->MeilleurCroissanteur();
            echo $data[0].", ".$data[1].", ".$data[2];
        }
    }

?>