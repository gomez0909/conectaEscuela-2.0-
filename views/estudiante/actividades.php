<?php

require_once "includes/auth_estudiante.php";
require_once "../../config/conexion.php";

$consulta = $conexion->prepare(
    "SELECT id, nombre, descripcion, fecha, lugar, horas, cupos
    FROM actividades
    WHERE estado = 'disponible'
    ORDER BY fecha ASC"
);

$consulta->execute();

$resultado = $consulta->get_result();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividades | ConectaEscuela</title>
    <link rel="stylesheet" href="../../assets/css/estudiante.css">
</head>

<body>

    <div class="dashboard">

        <?php include "includes/sidebar.php"; ?>

        <main class="main-content">

            <header class="topbar">

                <div>

                    <h1>Actividades</h1>

                    <p>Consulta las actividades de servicio social disponibles.</p>

                </div>

            </header>

            <section class="dashboard-content">

                <?php if ($resultado->num_rows > 0): ?>

                    <div class="activities-list">

                        <?php while ($actividad = $resultado->fetch_assoc()): ?>

                            <article class="activity-card">

                                <h3>
                                    <?php echo $actividad["nombre"]; ?>
                                </h3>

                                <p>
                                    <?php echo $actividad["descripcion"]; ?>
                                </p>

                                <p>
                                    <strong>Fecha:</strong>
                                    <?php echo $actividad["fecha"]; ?>
                                </p>

                                <p>
                                    <strong>Lugar:</strong>
                                    <?php echo $actividad["lugar"]; ?>
                                </p>

                                <p>
                                    <strong>Horas:</strong>
                                    <?php echo $actividad["horas"]; ?>
                                </p>

                                <p>
                                    <strong>Cupos:</strong>
                                    <?php echo $actividad["cupos"]; ?>
                                </p>

                                <a href="inscribirse.php?id=<?php echo $actividad["id"];?>">Inscribirme</a>

                            </article>

                        <?php endwhile; ?>

                    </div>

                <?php else: ?>

                    <p>No hay actividades disponibles en este momento.</p>

                <?php endif; ?>


            </section>

        </main>

    </div>

</body>

</html>