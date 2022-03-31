<?php
    namespace View;

    foreach($_POST as $k=>$v){echo $k."=>".$v."<br>";}
    foreach ($_SESSION as $k=>$v) { echo "SESSION : ".$k."=>".$v."<br>"; }

    include("Models/Connexion.php");
    use Models\Connexion as Connexion;

    include("Controllers/Statistiques.php");
    use Controllers\CntrlStatistiques as CntrlStats;
    $CtrlStat = new CntrlStats();


    if( isset($_POST['Connexion']) )
    {
        $co = new Connexion();
        $co->testCo($_POST['login'], $_POST['mdp']);
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Projet - index</title>
        <!-- <link rel="stylesheet" type="text/css" href="../style.css"> -->
    </head>
    <body>

    <?php if (!isset($_SESSION)){ ?>
        <h1>Croissantage</h1>

        <article>
            <h2>See you!</h2>
            <p>Neko! Neko! nya~ !</p>
            <sub>Just shut up n leave</sub>
        </article>

        <article>
            <h3>Connexion</h3>
            <form method='post'>
                <input type="text" name="login" pattern="[A-Za-z]{1,10}.[A-Za-z]{1,10}[0-9]{0,3}" placeholder="Log.in">
                <input type="password" name="mdp" pattern="[0-9A-Za-z?./!*$@&]{3,10}" placeholder="Password">
                <input type="submit" name="Connexion" value="Connexion">
            </form>
        </article>
    <?php
    }
    else
    {
    ?>
        <article>
            <h1>Bonjour <?php echo $_SESSION['nom']; ?></h1>
            <h4>Le meilleur croissanteur toutes catégories confondues : </h4>
            <?php  $CtrlStat->ShowMeilleurCroissanteur(); ?>
            <h4>Nombre de croissantages essuyés : <?php  $CtrlStat->AfficheNbFoisCroissanté(); ?></h4>
            <h4>Nombre de croissantages effectués : <?php  $CtrlStat->AfficheNbCroissantage(); ?></h4>
        </article>
    <?php
        if ( $_SESSION["role"]=="admin" )
        {
            include ("Admin.php");
        }
        elseif ( $_SESSION["role"]=="etudiant" )
        {
            include ("Accueil.php");
        }
    }
    ?>

      </body>

    <footer>
    <?php echo date('d/m/Y'); ?>
    </footer>
</html>