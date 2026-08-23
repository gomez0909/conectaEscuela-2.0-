<?php

session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: ../../../auth/login.php");
    exit;

}

if ($_SESSION["rol"] !== "estudiante") {

    header("Location: ../../../index.php");
    exit;

}

?>