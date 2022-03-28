<?php

    session_name('CroissantageParty');
    session_start();
    session_destroy();
    header('Location: ../index.php');
    exit;

?>