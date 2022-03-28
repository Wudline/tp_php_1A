<?php

    foreach($_POST as $k=>$v){echo $k."=>".$v."<br>";}

    include("Models/Connexion.php");

    if( isset($_POST['Connexion']) )
    { 
        $co = new Models\Connexion();
        $co->testCo($_POST['login'], $_POST['mdp']); 
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
    </header>

    <body>

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

      </body>

    <footer>
    <?php echo date('d/m/Y'); ?>
    </footer>
</html>