<?php

include 'header.php';

if (isset($_POST["usuario"]) && $_POST["usuario"] != "") {
    $usuario = $_POST["usuario"];
} else {
    $usuario = "";
}

?>


<main class="tarjeta">
    <div class="card">

            <form action="procesar.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">

                <h2>Reserva tu pase</h2>

                <div class="form-group">
                    <label for="nombre">Nombre Completo:</label>
                    <input id="nombre" type="text" name="nombre" required placeholder="Ej. Natalia Ante">
                </div>


                <div class="form-group">
                    <label for="email"> Correo electrónico:</label>
                    <input id="email" type="email" name="email" required placeholder="tu@email.com">
                </div>


                <div class="form-group">
                    <label for="edad">Edad:</label>
                    <input id="edad" type="number" name="edad" required>
                </div>

                <div class="form-group">
                    <p> Tipo de pase:</p>
                    <label><input type="radio" name="pase" value="General" required>General (50€)</label>
                    <label><input type="radio" name="pase" value="VIP con acceso a Backstage">VIP con acceso a Backstage (120€)</label>
                    <label><input type="radio" name="pase" value="Super VIP + Camping">Super VIP + Camping (180€)</label>
                </div>

                <div class="form-group">
                    <p> Días de Asistencia(+ 10€ por día):</p>
                    <label><input type="checkbox" name="dias[]" value="Viernes">Viernes</label>
                    <label><input type="checkbox" name="dias[]" value="Sábado">Sábado</label>
                    <label><input type="checkbox" name="dias[]" value="Domingo">Domingo</label>
                </div>

                <div class="form-group">
                    <label for="pago"> Método de pago:</label>
                    <select id="pago" name="pago" required>
                        <option value="" disabled selected>--Selecciona una opción--</option>
                        <option value="Tarjeta">Tarjeta de crédito</option>
                        <option value="Bizum">Bizum</option>
                        <option value="PayPal">PayPal</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="foto">Foto para la acreditación (JPG/PNG):</label>
                    <input  id="foto" type="file" name="foto" accept=".jpg,.jpeg,.png" required/>
                </div>

                <div class="form-group">
                    <label for="observaciones">Comentarios o peticiones especiales:</label>
                    <textarea id="observaciones" name="observaciones"></textarea>
                </div>

                <div class="boton">
                    <button type="submit">Generar acreditación</button>
                </div>
            </form>
    </div>
  </main>
</body>
</html>