<?php
    session_start();
    unset($_SESSION["usuario"]);
    unset($_SESSION["admin"]);
    session_destroy();
    header("location: ../index.php");
?>