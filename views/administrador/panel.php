<?php

session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: ../../auth/login.php");
    exit;

}

if ($_SESSION["rol"] !== "administrador") {

    header("Location: ../../index.php");
    exit;

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador | ConectaEscuela</title>
</head>
<body>
    
    <h1>Panel del administrador</h1>

    <p>
        Bienvenido, <?php echo $_SESSION["nombres"]; ?>
    </p>

    <a href="../../auth/cerrar_sesion.php">Cerrar Sesión</a>

</body>
</html>