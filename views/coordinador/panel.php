<?php

require_once "includes/auth_coordinador.php"

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coordinador | ConectaEscuela</title>
</head>
<body>
    
    <h1>Panel del coordinador</h1>

    <p>
        Bienvenido, <?php echo $_SESSION["nombres"]; ?>
    </p>

    <a href="../../auth/cerrar_sesion.php">Cerrar Sesión</a>

</body>
</html>