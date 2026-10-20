<?php
$usuarioActivo = "";

if (isset($idUsuario) && $idUsuario != "") {
    $usuarioActivo = $idUsuario;
} else if (isset($_POST["usuario"]) && !isset($_POST["contrasenia"])) {
    $usuarioActivo = $_POST["usuario"];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>GetaFest 2026</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<header class="cabecera">
    <h1>DEVMUSIC FEST 2026</h1>
    <h3>Sistema Oficial de Reserva y Acreditación Digital</h3>

    <?php if ($usuarioActivo != "") { ?>
        <h3>Usuario activo: <?php echo $usuarioActivo; ?> <a href="login.php">Cerrar Sesión / Salir</a></h3>
    <?php } else { ?>
        <h3> Acceso al portal: 🔑 <a href="login.php">Iniciar Sesión</a></h3>
    <?php } ?>
</header>