<?php

    foreach($_POST as $k=>$v){echo $k."=>".$v."<br>";}

    include("Controllers/Classe.php");
    include("Controllers/Croissant.php");
    include("Controllers/Etudiant.php");
    include("Controllers/Promo.php");
    include("Controllers/Statistiques.php");

    $CtrlClas = new Controllers\Classe();
    $CtrlCroi = new Controllers\Croissant();
    $CtrlEtud = new Controllers\Etudiant();
    $CtrlProm = new Controllers\Promo();
    $CtrlStat = new Controllers\Statistiques();

    include("Models/Classe.php");
    include("Models/Croissant.php");
    include("Models/Etudiant.php");
    include("Models/Promo.php");
    include("Models/Statistiques.php");

    $ModClas = new Models\Classe();
    $ModCroi = new Models\Croissant();
    $ModEtud = new Models\Etudiant();
    $ModProm = new Models\Promo();
    $ModStat = new Models\Statistiques();


    if( isset($_POST['NouvelEtudiant']) )
    {
        $login = $_POST['login']; 
        $nom = $_POST['nom'];
        $mdp = $_POST['mdp'];
        $viennoiserie = $_POST['viennoiserie'];
        $classe = $_POST['classe'];
        $promo = $_POST['promo'];

        verifAjoutEtudiant($login, $nom, $mdp, $viennoiserie, $classe, $promo);
    }

    if( isset($_POST['ModifEtudiant']) )
    {
        $id = $_POST['id'] ;
        $mdp = $_POST['mdp'] ;
        $classe = $_POST['classe'] ;

        verifModifMdpEtudiant($id, $mdp);
        verifModifClasseEtudiant($id, $classe);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Projet</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
    </head>

    <header>
        <h1>Croissantage</h1>
        <h2>Le meilleur croissanteur toutes catégories confondues : <?php  $CtrlStat->ShowMeilleurCroissanteur(); ?></h2>
    </header>

    <body>
        <article>
            <h3>Nouvel Etudiant</h3>
            <form method='post'>
                <input type="text" name="login" pattern="[A-Za-z]{1,10}.[A-Za-z]{1,10}" placeholder="Login">
                <input type="text" name="nom" pattern="[A-Za-z ]{3,50}'" placeholder="nom">
                <input type="password" name="mdp" pattern="[0-9A-Za-z?./!*$@&]{3,10}" placeholder="Password">
                <?php $CtrlCroi->SelectViennoiseries("Viennoiserie"); ?>
                <?php $CtrlClas->SelectClasses("Classe"); ?>
                <?php $CtrlProm->SelectPromos("Promo"); ?>

                <input type="submit" name="NouvelEtudiant" value="Ajouter">
            </form>
        </article>

        <article>
            <h3>Modifier Etudiant</h3>
            <form method='post'>
                <?php $CtrlEtud->SelectEtudiants("Etudiant", "IMR", "2022"); ?>
                <input type="password" name="mdp" pattern="[0-9A-Za-z?./!*$@&]{3,10}" placeholder="Password">
                <?php $CtrlClas->SelectClasses("Classe"); ?>

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