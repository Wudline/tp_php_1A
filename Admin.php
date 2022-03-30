<?php
    echo "_POST : <br>";
    foreach($_POST as $k=>$v){echo $k."=>".$v."<br>";}

    // echo "_SESSION : <br>";
    // foreach ($_SESSION as $k=>$v) { echo $k."=>".$v."<br>"; }

    include("Controllers/Statistiques.php");
    include("Controllers/Classe.php");
    include("Controllers/Croissant.php");
    include("Controllers/Etudiant.php");
    include("Controllers/Promo.php");

    use Controllers\CntrlClasse as CntrlClasse;
    use Controllers\CntrlCroissant as CntrlCroissant;
    use Controllers\CntrlEtudiant as CntrlEtudiant;
    use Controllers\CntrlPromo as CntrlPromo;
    use Controllers\CntrlStatistiques as CntrlStats;

    $CtrlClas = new CntrlClasse();
    $CtrlCroi = new CntrlCroissant();
    $CtrlEtud = new CntrlEtudiant();
    $CtrlProm = new CntrlPromo();
    $CtrlStat = new CntrlStats();


    if( isset($_POST['NouvelEtudiant']) )
    {
        echo $CtrlEtud->verifAjoutEtudiant($_POST["login"], $_POST["nom"], $_POST["mdp"], $_POST["Classe"], $_POST["Promo"], $_POST["Role"]);
    }

    if( isset($_POST['ModifierEtudiant']) )
    {
        echo $CtrlEtud->verifModifEtudiant($_POST["Etudiant"], $_POST["mdp"], $_POST["Classe"], $_POST["Role"]);
    }

    if( isset($_POST['NouveauCroissantage']) )
    {
        echo $CtrlCroi->NouveauCroissantage($_POST["Croissanteur"], $_POST["Croissanté"], $_POST["dateCroissantage"]);
    }

    if( isset($_POST['VoteCroissantage']) )
    {
        echo $CtrlCroi->VoteCroissantage($_POST["Croissanté"], $_POST["Etudiant"], $_POST["Viennoiserie"]);
    }

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Projet - admin</title>
        <!-- <link rel="stylesheet" type="text/css" href="../style.css"> -->
    </head>

    <header>
        <h1>Croissantage</h1>
        <h4>Le meilleur croissanteur toutes catégories confondues : </h4>
        <?php  $CtrlStat->ShowMeilleurCroissanteur(); ?>
    </header>

    <body>
        <article>
            <h3>Nouvel Etudiant</h3>
            <form method='post'>
                <input type="text" name="login" pattern="[A-Za-z]{1,10}.[A-Za-z]{1,10}" placeholder="Login">
                <input type="text" name="nom" placeholder="nom"><!-- pattern="[A-Za-z ]{3,50}'" -->
                <input type="password" name="mdp" pattern="[0-9A-Za-z?./!*$@&]{3,10}" placeholder="Password">
                <?php $CtrlClas->SelectClasses("Classe"); ?>
                <?php $CtrlProm->SelectPromo("Promo"); ?>
                <?php $CtrlEtud->SelectRole("Role"); ?>

                <input type="submit" name="NouvelEtudiant" value="Ajouter">
            </form>
        </article>


        <article>
            <h3>Modifier Etudiant</h3>
            <form method='post'>
                <?php $CtrlEtud->SelectEtudiants("Etudiant", "IMR", "2022"); ?>
                <input type="password" name="mdp" pattern="[0-9A-Za-z?./!*$@&]{3,10}" placeholder="Password">
                <?php $CtrlClas->SelectClasses("Classe"); ?>
                <?php $CtrlEtud->SelectRole("Role"); ?>


                <input type="submit" name="ModifierEtudiant" value="Modifier">
            </form>
        </article>

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

        <article>
            <h3>Vote Viennoiserie</h3>
            <form method='post'>

                <label>Réponse au croissantage de :</label>
                <?php $CtrlEtud->SelectEtudiants("Croissanté", "", ""); ?>

                <label>Etudiant</label>
                <?php $CtrlEtud->SelectEtudiants("Etudiant", "", ""); ?>

                <label>Viennoiserie</label>
                <?php $CtrlCroi->SelectViennoiseries("Viennoiserie"); ?>

                <input type="submit" name="VoteCroissantage" value="Choix">
            </form>
        </article>

      </body>

    <footer>
    <?php echo date('d/m/Y'); ?>
    </footer>
</html>