<?php

require_once "includes/auth_estudiante.php";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiante | ConectaEscuela</title>
    <link rel="stylesheet" href="../../assets/css/estudiante.css">
</head>
<body>
    
    <div class="dashboard">

        <?php include "includes/sidebar.php" ?>

        <main class="main-content">

            <header class="topbar">

                <div>

                    <h1>Hola, 
                        <?php echo $_SESSION["nombres"]; ?>
                    </h1>

                    <p>Bienvenido a tu panel de estudiante.</p>

                </div>

            </header>

            <section class="dashboard-content">

                <h2>Resumen de tu servicio social</h2>

                <div class="summary-card">

                    <h3>Horas realizadas</h3>

                    <p>0 horas</p>

                </div>

            </section>

        </main>

    </div>
    
</body>
</html>