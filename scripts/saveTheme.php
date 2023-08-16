<?php
    session_start();
    require("connection.php");

    $_SESSION['theme'] = $_POST['theme'];
?>