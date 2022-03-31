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

    if( isset($_POST['Commande']) )
    {
        echo $CtrlCroi->Commande($_POST["dateCmd"]);
    }
?>

    <hr>
    <hr>

    <article>
        <h3>Nouveau Croissantage</h3>
        <form method='post'>

            <input type="hidden"  name="Croissanteur" value="<?php echo $_SESSION['idlog']; ?>">

            <label>A ajouter à mon tableau des victimes : </label>
            <?php $CtrlEtud->SelectEtudiants("Croissanté", "", ""); ?>

            <label>, croissanté.e le : </label>
            <input type="date" name="dateCroissantage">

            <input type="submit" name="NouveauCroissantage" value="Croissantage">
        </form>
    </article>

    <hr>
    <hr>

    <article>
        <h3>Vote Viennoiserie</h3>
        <form method='post'>

            <label>Suite au croissantage de : </label>
            <?php $CtrlEtud->SelectEtudiants("Croissanté", "", ""); ?>

            <label>je demande : </label>
            <?php $CtrlCroi->SelectViennoiseries("Viennoiserie", "", ""); ?>

            <input type="hidden"  name="Etudiant" value="<?php echo $_SESSION['idlog']; ?>">

            <input type="submit" name="VoteCroissantage" value="Demander">
        </form>
    </article>

    <hr>
    <hr>

    <article>
        <h3>Suite à mon croissantage du : <?php $CtrlCroi->AfficheDateCroissantage(); ?></h3>
        <form method='post'>

            <label>Je commande à la date du : </label>
            <input type="date" name="dateCmd">

            <input type="submit" name="Commande" value="Commander">
        </form>
    </article>

    <hr>
    <hr>

    <article>
        <h3>Liste des étudiants de la même classe que moi</h3>
        <?php $CtrlEtud->AfficheEtudiants($_SESSION["classe"], $_SESSION["promo"]); ?>
    </article>