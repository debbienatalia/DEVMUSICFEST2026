<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: index.php');
    exit();
}

include 'header.php';

//Declaración de variables
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
$directorioDestino = 'images/';

if (!is_dir($directorioDestino)) {
    mkdir($directorioDestino, 0755, true);
}

$rutaFinal = $directorioDestino . $nombreOriginal;

if (!move_uploaded_file($rutaTemporal, $rutaFinal)){
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

foreach ( $asistencia as $dia) {

    $suplemento += 10;
}

$precio_total = $precio_base + $suplemento;

?>

<div class="acreditacion">

    <h2>GETAFEST 2026</h2>
    <h3>Acreditación Digital</h3>

    <img src="<?php echo $rutaFinal; ?>" alt="Foto del usuario" width="150">

    <h3>Datos del asistente</h3>

    <p>Nombre: <?php echo $nombreCompleto; ?></p>
    <p>Email: <?php echo $email; ?></p>

    <h3>Tipo de pase</h3>

    <p><?php echo $tipoEntrada; ?></p>

    <h3>Días de asistencia</h3>

    <?php
    foreach ($asistencia as $dia) {
        echo $dia . "<br>";
    }
    ?>

    <h3>Método de pago</h3>

    <p><?php echo $metodoPago; ?></p>

    <h3>Precio</h3>

    <p>Precio base: <?php echo $precio_base; ?> €</p>
    <p>Suplemento por días: <?php echo $suplemento; ?> €</p>
    <p class="precio-total">Total a pagar: <?php echo $precio_total; ?> €</p>

    <h3>Observaciones</h3>

    <p><?php echo $observaciones; ?></p>

    <div class="volver">
        <a href="index.php">← Volver al formulario</a>
    </div>

</div>

</body>
</html>


