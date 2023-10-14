<div class="auth-bg">
    <div class="pagina mensaje pagina__contenedor">
        <?php
            include_once __DIR__ . '/../templates/nombre-sitio.php'
        ?>

        <div class="instrucciones contenedor2">

        <?php include_once __DIR__ . '/../templates/alertas.php'?>

            <p class="instrucciones__descripcion">¡Cuenta creada correctamente!</p>
            <p class="instrucciones__descripcion">Hemos enviado las instrucciones para
                confirmar tu cuenta a tu correo...</p>

            <a href="/" class="formulario__boton">Ir a Login</a>

        </div>

        <?php
            include_once __DIR__ . '/../templates/footer.php'
        ?>

    </div>
</div>