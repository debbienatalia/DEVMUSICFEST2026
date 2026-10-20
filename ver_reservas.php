<?php

if (!isset($_POST["usuario"])) {
    echo "No se puede acceder";
    exit();
}

$usuario = $_POST["usuario"];

if ($usuario != "admin") {
    echo "Acceso denegado";
    exit();
}


include 'header.php';
?>

<main class="tarjeta" style="width: 900px;">
    <div class="card">
        <div class="card-header">
            <h2>Listado de Reservas</h2>

            <form action='index.php' method='POST'>
                <input type='hidden' name='usuario' value='<?php echo $usuario; ?>'>
                <input type='submit' class="boton-nueva-reserva" value='+ Nueva Reserva'>
            </form>
        </div>

        <?php
        $nombreFichero = "reservas.txt";

        if (file_exists($nombreFichero)) {
            $lineas = file($nombreFichero, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            ?>
            <table>
                <tr>
                    <th>Fecha</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Edad</th>
                    <th>Pase</th>
                    <th>Pago</th>
                    <th>Total</th>
                    <th>Acción Admin</th>
                </tr>
                <?php
                $id = 1;
                foreach ($lineas as $linea) {
                    list($fecha, $hora, $nombre, $email, $edad, $pase, $dias, $pago, $total, $foto, $observaciones) = explode("|", $linea);
                    ?>
                    <tr>
                        <td><?php echo "$fecha $hora"; ?></td>
                        <td><?php echo $nombre; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $edad; ?></td>
                        <td><?php echo $pase; ?></td>
                        <td><?php echo $pago; ?></td>
                        <td><?php echo $total; ?></td>
                        <td>
                            <form action='ver_pase.php' method='POST'>
                                <input type='hidden' name='id' value='<?php echo $id; ?>'>
                                <input type='hidden' name='usuario' value='admin'>
                                <input type='submit' class="boton-ver-pase" value='Ver Pase'>
                            </form>
                        </td>
                    </tr>
                    <?php
                    $id++;
                }
                ?>
            </table>
            <?php
        } else {
            echo "<p>No hay reservas aún</p>";
        }
        ?>
    </div>
</main>
</body>
</html>







