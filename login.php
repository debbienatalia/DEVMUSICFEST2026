<?php

$nombreFichero = "usuarios.txt";
$usuarios = [];
$idUsuario = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (file_exists($nombreFichero)) {
        $lineas = file($nombreFichero, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lineas as $linea) {
            list($usuario, $contrasenia) = explode(":", $linea);
            $usuarios[] = ['nombre' => $usuario, 'contraseña' => $contrasenia];
        }

        $usuarioIntroducido = $_POST["usuario"];
        $contraseniaIntroducida = $_POST["contrasenia"];

        foreach ($usuarios as $usuario) {
            if ($usuario["nombre"] == $usuarioIntroducido && $usuario["contraseña"] == $contraseniaIntroducida) {
                $idUsuario = $usuario["nombre"];
            }
        }

        if ($idUsuario == "") {
            $error = "Usuario o contraseña incorrectos.";
        }

    } else {
        $error = "Error: No existe el archivo $nombreFichero";
    }
}

if ($idUsuario != "") {
    include 'index.php';
    exit();
}

include 'header.php';

?>

<main class="tarjeta">
    <div class="card">

        <?php if ($error != "") { ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php } ?>

        <form action="login.php" method="post">

            <h2>Iniciar Sesión</h2>

            <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input id="usuario" type="text" name="usuario" required placeholder="Ingresa tu usuario">
            </div>

            <div class="form-group">
                <label for="contrasenia">Contraseña</label>
                <input id="contrasenia" type="password" name="contrasenia" required placeholder="Ingresa tu contraseña">
            </div>

            <div class = "boton">
                <button type="submit">Entrar al Sistema</button>
            </div>

        </form>
    </div>
</main>
</body>
</html>



