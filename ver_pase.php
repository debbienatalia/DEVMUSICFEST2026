<?php

if (!isset($_POST["usuario"]) || !isset($_POST["id"])){
    echo "No se puede acceder";
    exit();
}

$usuario = $_POST["usuario"];
$id = $_POST["id"];

if ($usuario != "admin") {
    echo "Acceso denegado";
    exit();
}

include 'header.php';

$nombreFichero = "reservas.txt";
?>

<main class="tarjeta">
    <div class="card">
        <?php
        if (file_exists($nombreFichero)) {
            $lineas = file($nombreFichero, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            $contador = 1;
            $encontrada = false;

            foreach ($lineas as $linea) {
                list($fecha, $hora, $nombre, $email, $edad, $pase, $dias, $pago, $total, $foto, $observaciones) = explode("|", $linea);

                if ($contador == $id) {
                    $encontrada = true;
                    ?>
                    <h2 class="titulo-acreditacion">Acreditación #<?php echo $id; ?> (Vista Administrador)</h2>

                    <div class="acreditacion">
                        <img src="<?php echo $foto; ?>" alt="Foto de <?php echo $nombre; ?>">
                        <h3><?php echo $nombre; ?></h3>
                        <p><strong>Email:</strong> <?php echo $email; ?></p>
                        <p><strong>Edad:</strong> <?php echo $edad; ?> años</p>
                        <p><strong>Tipo de Entrada:</strong> <?php echo $pase; ?></p>
                        <p><strong>Días de asistencia:</strong> <?php echo $dias; ?></p>
                        <p><strong>Método de pago:</strong> <?php echo $pago; ?></p>
                        <?php if (!empty($observaciones)) { ?>
                            <p class="observaciones">"<?php echo $observaciones; ?>"</p>
                        <?php } ?>
                        <p class="precio-total">Total: <?php echo $total; ?></p>
                    </div>

                    <div class="volver">
                        <form action='ver_reservas.php' method='post'>
                            <input type='hidden' name='usuario' value='<?php echo $usuario; ?>'>
                            <input type='submit' value='← Volver al listado de reservas'>
                        </form>
                    </div>
                    <?php
                }
                $contador++;
            }

            if (!$encontrada) {
                echo "<p>No se ha encontrado la reserva</p>";
            }

        } else {
            echo "<p>Todavía no hay reservas guardadas</p>";
        }
        ?>
    </div>
</main>
</body>
</html>
