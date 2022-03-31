<?php
    namespace View;

    // foreach($_POST as $k=>$v){echo "POST : ".$k."=>".$v."<br>";}
    // foreach ($_SESSION as $k=>$v) { echo "SESSION : ".$k."=>".$v."<br>"; }

    include("Controllers/Croissant.php");
    include("Controllers/Etudiant.php");

    use Controllers\CntrlCroissant as CntrlCroissant;
    use Controllers\CntrlEtudiant as CntrlEtudiant;

    $CtrlCroi = new CntrlCroissant();
    $CtrlEtud = new CntrlEtudiant();

    if( isset($_POST['NouveauCroissantage']) )
    {
        echo $CtrlCroi->NouveauCroissantage($_POST["Croissanteur"], $_POST["Croissanté"], $_POST["dateCroissantage"]);
    }

    if( isset($_POST['VoteCroissantage']) )
    {
        echo $CtrlCroi->VoteCroissantage($_POST["Croissanté"], $_POST["Etudiant"], $_POST["Viennoiserie"]);
    }

?>

    <hr>
    <hr>

    <article>
        <h3>Nouveau Croissantage</h3>
        <form method='post'>

            <label>Croissanteur</label>
            <?php $CtrlEtud->SelectEtudiants("Croissanteur", "", ""); ?>

            <label>Croissanté</label>
            <?php $CtrlEtud->SelectEtudiants("Croissanté", "", ""); ?>

            <label>Date du Croissantage</label>
            <input type="date" name="dateCroissantage">

            <label>Date de la Commande</label>
            <input type="date" name="dateCommande">

            <input type="submit" name="NouveauCroissantage" value="Croissantage">
        </form>
    </article>

    <hr>
    <hr>

    <article>
        <h3>Liste des étudiants de la même classe que moi</h3>
        <?php $CtrlEtud->AfficheEtudiants($_SESSION["classe"], $_SESSION["promo"]); ?>
    </article>