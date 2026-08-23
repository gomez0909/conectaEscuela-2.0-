<?php

session_start();

require_once "../config/conexion.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = trim($_POST["correo"]);
    $password = $_POST["password"];

    if (empty($correo) || empty($password)) {
        $mensaje = "Todos los campos son obligatorios.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "El correo electrónico no es válido";
    } else {
        $consulta = $conexion->prepare(
            "SELECT id, nombres, apellidos, correo, password, rol, estado
            FROM usuarios
            WHERE correo = ?"
        );

        $consulta->bind_param(
            "s",
            $correo
        );

        $consulta->execute();

        $resultado = $consulta->get_result();

        if ($resultado->num_rows === 1) {

            $usuario = $resultado->fetch_assoc();
            
            if ($usuario["estado"] !== "activo") {
                $mensaje = "Este usuario se encuentra inactivo.";
            
        } elseif (password_verify($password, $usuario["password"])) {

            session_regenerate_id(true);

            $_SESSION["user_id"] = $usuario["id"];
            $_SESSION["nombres"] = $usuario["nombres"];
            $_SESSION["apellidos"] = $usuario["apellidos"];
            $_SESSION["correo"] = $usuario["correo"];
            $_SESSION["rol"] = $usuario["rol"];

            if ($usuario["rol"] === "estudiante") {

                header("Location: ../views/estudiante/panel.php");
                exit;

            } elseif ($usuario["rol"] === "coordinador") {

                header("Location: ../views/coordinador/panel.php");
                exit;

            } elseif ($usuario["rol"] === "administrador") {

                header("Location: ../views/administrador/panel.php");
                exit;

            }   else {

                $mensaje = "El usuario no tiene un rol valido.";

            } 

        } else {
            $mensaje = "Correo o contraseña incorrectos.";
        }

        } else {
            $mensaje = "Correo o contraseñas incorrectos.";
        }

        $consulta->close();
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | ConectaEscuela</title>
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>

<main class="auth-container">
    <section class="auth-card">

        <h1>Iniciar Sesión</h1>
        <p>Ingresa tus datos para acceder a ConectaEscuela</p>

        <?php if (!empty($mensaje)): ?>
            <p class="mensaje"><?php echo $mensaje; ?></p>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <label for="correo">Correo Electrónico</label>
            <input type="email" id="correo" name="correo" required>
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">
                Iniciar Sesión
            </button>
        </form>
    </section>
</main>
    
</body>
</html>