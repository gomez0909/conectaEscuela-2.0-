<?php

require_once "../config/conexion.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombres = trim($_POST["nombres"]);
    $apellidos = trim($_POST["apellidos"]);
    $correo = trim($_POST["correo"]);
    $codigo_estudiantil = trim($_POST["codigo_estudiantil"]);
    $grado = trim($_POST["grado"]);
    $seccion = trim($_POST["seccion"]);

    $password = $_POST["password"];
    $confirmar_password = $_POST["confirmar_password"];

    if (

        empty($nombres) ||
        empty($apellidos) ||
        empty($correo) ||
        empty($codigo_estudiantil) ||
        empty($grado) ||
        empty($seccion) ||
        empty($password) ||
        empty($confirmar_password)

    ) {

        $mensaje = "Todos los campos son obligatorios.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "El correo electrónico no es válido.";
    } elseif (!preg_match('/@inemjose\.edu\.co$/i', $correo)) {
        $mensaje = "Debes registrarte con tu correo institucional: ...@inemjose.edu.co.";
    } elseif (!preg_match('/^(?=.*[A-Z])(?=.*[0-9]).{8,}$/', $password)) {
        $mensaje = "La contraseña debe tener al menos 8 caracteres, una mayúscula y un número.";
    } elseif ($password !== $confirmar_password) {
        $mensaje = "Las contraseñas no coinciden.";
    } else {
        $consultaCorreo = $conexion->prepare(
            "SELECT id FROM usuarios WHERE correo = ?"
        );

        $consultaCorreo->bind_param(
            "s",
            $correo
        );

        $consultaCorreo->execute();

        $resultadoCorreo = $consultaCorreo->get_result();

        $consultaCodigo = $conexion->prepare(
            "SELECT id FROM usuarios WHERE codigo_estudiantil = ?"
        );

        $consultaCodigo->bind_param(
            "s",
            $codigo_estudiantil
        );

        $consultaCodigo->execute();

        $resultadoCodigo = $consultaCodigo->get_result();

        if ($resultadoCorreo->num_rows > 0) {
            $mensaje = "El correo electrónico ya está registrado.";
        } elseif ($resultadoCodigo->num_rows > 0) {
            $mensaje = "El codigo estudiantil ya está registrado.";
        } else {

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $rol = "estudiante";
            $estado = "activo";

            $registro = $conexion->prepare(
                "INSERT INTO usuarios
        (nombres, apellidos, correo, password, codigo_estudiantil, grado, seccion, rol, estado)
        VALUES (?,?,?,?,?,?,?,?,?)"
            );

            $registro->bind_param(
                "sssssssss",
                $nombres,
                $apellidos,
                $correo,
                $password_hash,
                $codigo_estudiantil,
                $grado,
                $seccion,
                $rol,
                $estado
            );

            if ($registro->execute()) {
                $mensaje = "Usuario registrado correctamente.";
            } else {
                $mensaje = "Ocurrió un error al registrar al usuario.";
            }

            $registro->close();

        }

        $consultaCorreo->close();
        $consultaCodigo->close();

    }

}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse | ConectaEscuela</title>
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>

<body>

    <main class="auth-container">
        <section class="auth-card">

            <h1>Crear cuenta</h1>

            <p>Registrate como estudiante en ConectaEscuela.</p>

            <?php if (!empty($mensaje)): ?>
                <p><?php echo $mensaje; ?></p>
            <?php endif; ?>

            <form action="registro.php" method="POST">

                <label for="nombres">Nombres</label>
                <input type="text" id="nombres" name="nombres" required>

                <label for="apellidos">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos" required>

                <label for="correo">Correo Electrónico</label>

                <input type="email" id="correo" name="correo" pattern=".+@inemjose\.edu\.co"
                    title="Debes usar tu correo institucional @inemjose.edu.co." required>

                <label for="codigo_estudiantil">Código estudiantil</label>
                <input type="text" id="codigo_estudiantil" name="codigo_estudiantil" required>

                <label for="grado">Grado</label>
                <input type="text" id="grado" name="grado" required>

                <label for="seccion">Grupo / Seccion</label>
                <input type="text" id="seccion" name="seccion" required>

                <label for="password">Contraseña</label>
                <div class="campo-password">
                    <input type="password" id="password" name="password" minlength="8"
                        pattern="(?=.*[A-Z])(?=.*[0-9]).{8,}" title="Mínimo 8 caracteres, una mayúscula y un número."
                        required>
                    <button type="button" class="toggle-password" data-target="password"
                        aria-label="Mostrar contraseña">
                        <!-- Ojo cerrado -->
                        <svg class="ojo ojo-cerrado" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 3l18 18"></path>
                            <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"></path>
                            <path d="M9.9 4.2A10.5 10.5 0 0 1 12 4c5 0 9 5 9 5a15 15 0 0 1-2.1 2.7"></path>
                            <path d="M6.6 6.6C4.4 8 3 10 3 10s4 5 9 5a8 8 0 0 0 3.4-.8"></path>
                        </svg>
                        <!-- Ojo abierto -->
                        <svg class="ojo ojo-abierto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>


                <label for="confirmar_password">Confirmar contraseña</label>
                <div class="campo-password">
                    <input type="password" id="confirmar_password" name="confirmar_password" required>
                    <button type="button" class="toggle-password" data-target="confirmar_password"
                        aria-label="Mostrar contraseña">
                        <!-- Ojo cerrado -->
                        <svg class="ojo ojo-cerrado" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 3l18 18"></path>
                            <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"></path>
                            <path d="M9.9 4.2A10.5 10.5 0 0 1 12 4c5 0 9 5 9 5a15 15 0 0 1-2.1 2.7"></path>
                            <path d="M6.6 6.6C4.4 8 3 10 3 10s4 5 9 5a8 8 0 0 0 3.4-.8"></path>
                        </svg>
                        <!-- Ojo abierto -->
                        <svg class="ojo ojo-abierto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>

                <button type="submit">Crear cuenta</button>

            </form>

        </section>
    </main>

    <script src="../assets/js/focus.js"></script>

</body>

</html>