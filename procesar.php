<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: index.php');
    exit();
}

include 'header.php';

$usuario = $_POST['usuario'];
$nombreCompleto = $_POST['nombre'];
$email = $_POST['email'];
$edad = $_POST['edad'];
$tipoEntrada = $_POST['pase'];
$metodoPago = $_POST['pago'];
$observaciones = $_POST['observaciones'];

if (isset($_POST['dias'])) {
    $asistencia = $_POST['dias'];
} else {
    $asistencia = array();
}

if (empty($nombreCompleto)) {
    echo "El nombre y apellidos son obligatorios";
    exit();
}

if (empty($email)) {
    echo "El correo electrónico es obligatorio";
    exit();
}

if (!is_numeric($edad)) {
    echo "La edad debe ser un número";
    exit();
}

if ($edad < 18) {
    echo "No se permite la entrada a menores. El evento es exclusivo para mayores de edad.";
    exit();
}

if (!isset($_FILES['foto']) || $_FILES['foto']['error'] != 0) {
    echo "No se ha subido correctamente la imagen";
    exit();
}

$archivo = $_FILES['foto'];
$rutaTemporal = $archivo['tmp_name'];
$nombreOriginal = $archivo['name'];
$extension = pathinfo($nombreOriginal, PATHINFO_EXTENSION);
$nombreNuevo = uniqid() . '.' . $extension;
$directorioDestino = 'uploads/';

if (!is_dir($directorioDestino)) {
    mkdir($directorioDestino, 0755, true);
}

$rutaFinal = $directorioDestino . $nombreNuevo;

if (!move_uploaded_file($rutaTemporal, $rutaFinal)) {
    echo "La imagen no se pudo subir";
    exit();
}

$precio_base = 0;

switch ($tipoEntrada) {

    case 'General':
        $precio_base = 50;
        break;

    case 'VIP con acceso a Backstage':
        $precio_base = 120;
        break;

    case 'Super VIP + Camping':
        $precio_base = 180;
        break;
}

$suplemento = 0;

foreach ($asistencia as $dia) {
    $suplemento += 10;
}

$precio_total = $precio_base + $suplemento;

$fecha = date("Y-m-d");
$hora = date("H:i:s");
$textoDias = implode(", ", $asistencia);

$linea = $fecha."|".$hora."|".$nombreCompleto."|".$email."|".$edad."|".$tipoEntrada."|".$textoDias."|".$metodoPago."|".$precio_total."€"."|".$rutaFinal."|".$observaciones.PHP_EOL;
file_put_contents("reservas.txt", $linea, FILE_APPEND);

?>

<main class="tarjeta">
    <div class="card">

        <div class="acreditacion">
            <img src="<?php echo $rutaFinal; ?>" alt="Foto de <?php echo $nombreCompleto; ?>">
            <h3><?php echo $nombreCompleto; ?></h3>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Tipo de Entrada:</strong> <?php echo $tipoEntrada; ?></p>
            <p><strong>Días de asistencia:</strong> <?php echo $textoDias; ?></p>
            <p><strong>Método de pago:</strong> <?php echo $metodoPago; ?></p>
            <p><strong>Precio base:</strong> <?php echo $precio_base; ?> €</p>
            <p><strong>Suplemento por días:</strong> <?php echo $suplemento; ?> €</p>
            <?php if (!empty($observaciones)) { ?>
                <p class="observaciones">"<?php echo $observaciones; ?>"</p>
            <?php } ?>
            <p class="precio-total">Total a pagar: <?php echo $precio_total; ?>€</p>
        </div>

        <div class="volver">
            <form action="index.php" method="post">
                <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
                <input type="submit" value="← Volver al formulario">
            </form>

            <form action="ver_reservas.php" method="post">
                <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
                <input type="submit" value="Ver reservas">
            </form>
        </div>

    </div>
</main>
</body>
</html>