<?php

require_once "includes/auth_estudiante.php";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progreso | ConectaEscuela</title>
    <link rel="stylesheet" href="../../assets/css/estudiante.css">
</head>
<body>
    
    <div class="dashboard">

        <?php include "includes/sidebar.php" ?>

        <main class="main-content">

            <header class="topbar">

                <div>

                    <h1>Mi progreso</h1>

                    <p>Consulta el avance de tu servicio social estudiantil.</p>

                </div>

            </header>

            <section class="dashboard-content">

                <p>Aquí aparecerá el progreso de tus horas de servicio social.</p>

            </section>

        </main>

    </div>
    
</body>
</html>