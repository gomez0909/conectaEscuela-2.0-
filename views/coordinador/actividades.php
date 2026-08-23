<?php

    require_once("includes/auth_coordinador.php");
    require_once("../../config/conexion.php");

    $coordinador_id = $_SESSION["user_id"];

    $consulta = $conexion->prepare(
        "SELECT id, nombre, descripcion, fecha, lugar, horas, cupos, estado
        FROM actividades 
        WHERE creado_por = ?
        ORDER BY fecha ASC"
    );

    $consulta->bind_param(
        "i",
        $coordinador_id
    );

    $consulta->execute();

    $resultado = $consulta->get_result();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis actividades | ConectaEscuela</title>
</head>
<body>
    
    <h1>Mis actividades creadas</h1>

    <a href="crear_actividad.php">Crear actividad nueva</a>

    <?php if($resultado->num_rows > 0): ?>
        <?php while($actividad = $resultado->fetch_assoc()): ?>

            <div>

                <h2>
                    <?php echo $actividad["nombre"]; ?>
                </h2>

                <p>
                    <?php echo $actividad["descripcion"]; ?>
                </p>

                <p>
                    Fecha:
                    <?php echo $actividad["fecha"]; ?>
                </p>

                <p>
                    Lugar:
                    <?php echo $actividad["lugar"]; ?>
                </p>

                <p>
                    Horas:
                    <?php echo $actividad["horas"]; ?>
                </p>

                <p>
                    Cupos:
                    <?php echo $actividad["cupos"]; ?>
                </p>

                <p>
                    Estado:
                    <?php echo $actividad["estado"]; ?>
                </p>

            </div>

        <?php endwhile; ?> 
        
    <?php else: ?> 
        
        <p>
            Aún no haz creado ninguna actividad.
        </p>

    <?php endif; ?>

</body>
</html>