<?php
    namespace View;

    include("Controllers/Statistiques.php");
    include("Controllers/Classe.php");
    include("Controllers/Croissant.php");
    include("Controllers/Etudiant.php");
    include("Controllers/Promo.php");

    use Controllers\CntrlStatistiques as CntrlStats;
    use Controllers\CntrlClasse as CntrlClasse;
    use Controllers\CntrlCroissant as CntrlCroissant;
    use Controllers\CntrlEtudiant as CntrlEtudiant;
    use Controllers\CntrlPromo as CntrlPromo;

    foreach($_POST as $k=>$v){echo $k."=>".$v."<br>";}

    include("Models/Connexion.php");
    use Models\Connexion as Connexion;

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

    <header>
        <h1>Croissantage</h1>
    </header>

    <body>

    <?php if (!isset($_SESSION)){ ?>
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
    elseif ( $_SESSION["role"]=="admin" )
    {
        // include ("Admin.php");
    }
    elseif ( $_SESSION["role"]=="etudiant" )
    {
        echo "We're all mad here...<br>";
    }
    ?>

      </body>

    <footer>
    <?php echo date('d/m/Y'); ?>
    </footer>
</html>