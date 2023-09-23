<div class="pagina login pagina__contenedor">
    <?php
        include_once __DIR__ . '/../templates/nombre-sitio.php'
    ?>

    <div class="instrucciones contenedor2">

    <?php include_once __DIR__ . '/../templates/alertas.php'?>

        <p class="instrucciones__descripcion">Inicia Sesión:</p>

        <form action="/" method="POST" class="formulario">
            <div class="formulario__campo">
                <label for="email">Correo:</label>
                <input 
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Ingresa tu Correo"
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

            <input type="submit" value="Iniciar Sesión" class="formulario__boton">

        </form>

        <div class="acciones">
            <a href="/registrar">¿Aún no tienes una cuenta? <span>Obtener una</span></a>
            <a href="/olvide">¿Olvidaste tu Password? <span>Reestablecela</span></a>
        </div>
        
    </div>

    <?php
        include_once __DIR__ . '/../templates/footer.php'
    ?>
    
</div>