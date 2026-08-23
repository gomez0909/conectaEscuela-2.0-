<?php

require_once "includes/auth_coordinador.php";
require_once "../../config/conexion.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"]);
    $descripcion = trim($_POST["descripcion"]);
    $fecha = $_POST["fecha"];
    $lugar = trim($_POST["lugar"]);

    $horas = $_POST["horas"];
    $cupos = $_POST["cupos"];

    if (
        empty($nombre) ||
        empty($descripcion) ||
        empty($fecha) ||
        empty($lugar) ||
        empty($horas) ||
        empty($cupos)
    ) {
        $mensaje = "Todos los campos son necesarios.";
    } elseif ($horas <= 0) {
        $mensaje = "Las horas deben ser mayores que cero.";
    } elseif ($cupos <= 0) {
        $mensaje = "Los cupos deben ser mayores que cero.";
    } else {

        $creado_por = $_SESSION["user_id"];

        $estado = "disponible";

    $registro = $conexion->prepare(
        "INSERT INTO actividades
        (nombre, descripcion, fecha, lugar, horas, cupos, estado, creado_por)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );

    $registro->bind_param(
        "ssssiisi",
        $nombre,
        $descripcion,
        $fecha,
        $lugar,
        $horas,
        $cupos,
        $estado,
        $creado_por
    );

    if ($registro->execute()) {
        $mensaje = "Actividad creada correctamente";
    } else {
        $mensaje = "Ocurrió un error al crear la actividad";
    }

    $registro->close();

    }

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Actividad | ConectaEscuela</title>
</head>
<body>

    <main>

        <section>

            <h1>Crear actividad</h1>

            <p>Registra una nueva actividad de servicio social.</p>

            <?php if (!empty($mensaje)): ?>
                <p>
                    <?php echo $mensaje; ?>
                </p>
            <?php endif; ?>

            <form action="crear_actividad.php" method="POST">

                <label for="nombre">Nombre de la actividad</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="descripcion">Descripcion</label>
                <textarea id="descripcion" name="descripcion" required></textarea>

                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha" required>

                <label for="lugar">Lugar</label>
                <input type="text" id="lugar" name="lugar" required>
                
                <label for="horas">Horas otorgadas</label>
                <input type="number" id="horas" name="horas" min="1" required>

                <label for="cupos">Número de cupos</label>
                <input type="number" id="cupos" name="cupos" min="1" required>

                <button type="submit">Crear actividad</button>

            </form>

        </section>

    </main>
    
</body>
</html>