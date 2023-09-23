<div class="pagina recuperar pagina__contenedor">
    <?php
        include_once __DIR__ . '/../templates/nombre-sitio.php'
    ?>
    
    <div class="instrucciones contenedor2">

    <?php include_once __DIR__ . '/../templates/alertas.php'?>
    
        <p class="instrucciones__descripcion">Crea tu nueva Contraseña:</p>

        <?php if($error) return ?>

        <form class="formulario" method="POST">

            <div class="formulario__campo">
                <label for="password">Contraseña:</label>
                <input 
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Actualiza tu Contraseña"
                >
            </div>

            <div class="opciones-recupera">
                <input type="submit" value="Cambiar Contraseña" class="formulario__boton">
                <a href="/" class="formulario__boton">Ir a Login</a>
            </div>
        </form>

    </div>

    <?php
        include_once __DIR__ . '/../templates/footer.php'
    ?>
    
</div>