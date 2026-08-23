<?php

    require_once("includes/auth_estudiante.php");
    require_once("../../config/conexion.php");

    if(!isset($_GET["id"])) {
        header("Location: actividades.php");
        exit();
    }

    $actividad_id = (int) $_GET["id"];
    $estudiante_id = $_SESSION["user_id"];

    $consultaActividad = $conexion->prepare(
        "SELECT id, cupos, estado
        FROM actividades 
        WHERE id = ?"
    );

    $consultaActividad->bind_param(
        "i",
        $actividad_id
    );

    $consultaActividad->execute();

    $resultadoActividad = $consultaActividad->get_result();

    if($resultadoActividad->num_rows !== 1) {
        die("La actividad no existe.");
    }

    $actividad = $resultadoActividad->fetch_assoc();

    if($actividad["estado"] !== "disponible") {
        die("Esta actividad no está disponible.");
    }

    $consultaInscripcion = $conexion->prepare(
        "SELECT id 
        FROM inscripciones
        WHERE estudiante_id = ?
        AND actividad_id = ?"
    );

    $consultaInscripcion->bind_param(
        "ii",
        $estudiante_id,
        $actividad_id
    );

    $consultaInscripcion->execute();

    $resultadoInscripcion = $consultaInscripcion->get_result();

    if($resultadoInscripcion->num_rows > 0) {
        die("Ya está inscrito en la actividad.");
    }

    $estado = "inscrito";

    $registro = $conexion->prepare(
        "INSERT INTO inscripciones
        (estudiante_id, actividad_id, estado)
        VALUES (?, ?, ?)"
    );

    $registro->bind_param(
        "iis",
        $estudiante_id,
        $actividad_id,
        $estado
    );

    if($registro->execute()) {
        header("Location: mis_actividades.php");
        exit;
    } else {
        die("Ocurrió un error al realizar la inscripcion");
    }

?>