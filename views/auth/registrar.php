<div class="auth-bg">
    <div class="pagina registrar pagina__contenedor">
        <?php
            include_once __DIR__ . '/../templates/nombre-sitio.php'
        ?>

        <div class="instrucciones contenedor2">

        <?php include_once __DIR__ . '/../templates/alertas.php'?>

            <p class="instrucciones__descripcion">Crear Cuenta:</p>

            <form action="/registrar" method="POST" class="formulario">
                <div class="formulario__campo">
                    <label for="nombre">Nombre:</label>
                    <input 
                        type="text"
                        id="nombre"
                        name="nombre"
                        placeholder="Ingresa tu nombre"
                        value="<?php echo s($usuario->nombre) ?>"
                    >
                </div>

                <div class="formulario__campo">
                    <label for="email">Correo:</label>
                    <input 
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Ingresa tu Correo"
                        value="<?php echo s($usuario->email) ?>"
                    >
                </div>

                <div class="formulario__campo">
                    <label for="password">Contraseña:</label>
                    <input 
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Ingresa tu Contraseña"
                    >
                </div>

                <div class="formulario__campo">
                    <label for="password2">Repite Contraseña:</label>
                    <input 
                        type="password"
                        id="password2"
                        name="password2"
                        placeholder="Repetir Contraseña"
                    >
                </div>

                <input type="submit" value="Crear Cuenta" class="formulario__boton">

            </form>

            <div class="acciones">
                <a href="/">¿Ya tienes cuenta? <span>Inicia Sesión</span></a>
                <a href="/olvide">¿Olvidaste tu Password? <span>Reestablecela</span></a>
            </div>

        </div>

        <?php
            include_once __DIR__ . '/../templates/footer.php'
        ?>
    </div>
</div>