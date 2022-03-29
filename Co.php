<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Projet</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
    </head>

    <h1>GG tu es co</h1>
    <a href="Controllers/Deconnexion.php">Déconnexion</a>

    <?php
        foreach ($_SESSION as $key=>$value) { echo $key." => ".$value."<br>"; }
    ?>
    
</html>