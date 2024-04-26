<div class="auth-bg">
    <div class="pagina login">
        <div class="pagina__grid">

            <div class="logo-site">
                <?php
                    include_once __DIR__ . '/../templates/nombre-sitio.php'
                ?>
            </div>    
            
            <div class="instrucciones contenedor2">
            
                <p class="titulo2">Inicia Sesión:</p>

                <?php include_once __DIR__ . '/../templates/alertas.php'?>
            
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
        </div>

    </div>
</div>