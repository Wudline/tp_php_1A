<?php

    namespace Tools;

    class CSRF
    {
        function createToken ()
        {
            return $_SESSION['token'] = "ToK".$_SESSION['login']."En".date("Ymd::Hms");
        }

        function getToken ($token)
        {

        }

        function checkToken ($token)
        {

        }

        function removeToken ($token)
        {

        }
    }

?>