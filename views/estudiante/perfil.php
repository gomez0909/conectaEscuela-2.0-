<?php

require_once "includes/auth_estudiante.php";
require_once "../../config/conexion.php";

$user_id = $_SESSION["user_id"];

$consulta = $conexion->prepare(
    "SELECT nombres, apellidos, correo, codigo_estudiantil, grado, seccion FROM usuarios WHERE id = ?"
);

$consulta->bind_param(
    "i",
    $user_id
);

$consulta->execute();

$resultado = $consulta->get_result();

$estudiante = $resultado->fetch_assoc();

$consulta->close();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi perfil | ConectaEscuela</title>
    <link rel="stylesheet" href="../../assets/css/estudiante.css">
</head>
<body>
    
    <div class="dashboard">

        <?php include "includes/sidebar.php" ?>

        <main class="main-content">

            <header class="topbar">

                <div>

                    <h1>Mi perfil</h1>

                    <p>Consulta información personal</p>

                </div>

            </header>

            <section class="dashboard-content">

                <div class="profile-card">

                    <p>
                        <strong>Nombres:</strong>
                        <?php echo $estudiante["nombres"]; ?>
                    </p>

                    <p>
                        <strong>Apellidos:</strong>
                        <?php echo $estudiante["apellidos"]; ?>
                    </p>

                    <p>
                        <strong>Correo:</strong>
                        <?php echo $estudiante["correo"]; ?>
                    </p>

                    <p>
                        <strong>Código estudiantil:</strong>
                        <?php echo $estudiante["codigo_estudiantil"]; ?>
                    </p>

                    <p>
                        <strong>Grado:</strong>
                        <?php echo $estudiante["grado"]; ?>
                    </p>

                    <p>
                        <strong>Grupo / Seccion:</strong>
                        <?php echo $estudiante["seccion"]; ?>
                    </p>

                </div>

            </section>

        </main>

    </div>

</body>
</html>