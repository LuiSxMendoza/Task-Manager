<div class="auth-bg">
    <div class="pagina recuperar">
        <div class="pagina__grid">

            <div class="logo-site">
                <?php
                    include_once __DIR__ . '/../templates/nombre-sitio.php'
                ?>
            </div>
            
            <div class="instrucciones contenedor2">
            
                <p class="titulo2">Crea tu nueva Contraseña:</p>
            
                <?php include_once __DIR__ . '/../templates/alertas.php'?>
            
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

        </div>
    </div>
</div>