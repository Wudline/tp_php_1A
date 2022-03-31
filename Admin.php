<?php
    namespace View;

    include("Controllers/Classe.php");
    include("Controllers/Croissant.php");
    include("Controllers/Etudiant.php");
    include("Controllers/Promo.php");

    use Controllers\CntrlClasse as CntrlClasse;
    use Controllers\CntrlCroissant as CntrlCroissant;
    use Controllers\CntrlEtudiant as CntrlEtudiant;
    use Controllers\CntrlPromo as CntrlPromo;

    $CtrlClas = new CntrlClasse();
    $CtrlCroi = new CntrlCroissant();
    $CtrlEtud = new CntrlEtudiant();
    $CtrlProm = new CntrlPromo();


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

    <hr>
    <hr>

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

    <hr>
    <hr>

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
        <h3>Liste des étudiants</h3>
        <label>IMR - 2020</label>
        <?php $CtrlEtud->AfficheEtudiants("IMR", "2020"); ?>
        <br>
        <label>IPS - 2020</label>
        <?php $CtrlEtud->AfficheEtudiants("IPS", "2020"); ?>
        <hr>
        <label>IMR - 2021</label>
        <?php $CtrlEtud->AfficheEtudiants("IMR", "2021"); ?>
        <br>
        <label>IPS - 2021</label>
        <?php $CtrlEtud->AfficheEtudiants("IPS", "2021"); ?>
        <hr>
        <label>IMR - 2022</label>
        <?php $CtrlEtud->AfficheEtudiants("IMR", "2022"); ?>
        <br>
        <label>IPS - 2022</label>
        <?php $CtrlEtud->AfficheEtudiants("IPS", "2022"); ?>

    </article>