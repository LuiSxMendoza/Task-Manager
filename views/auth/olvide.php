<div class="auth-bg">
    <div class="pagina olvide">
        <div class="pagina__grid">

            <div class="logo-site">
                <?php
                    include_once __DIR__ . '/../templates/nombre-sitio.php'
                ?>
            </div>
            
            <div class="instrucciones contenedor2">
            
                <p class="titulo2">Olvidé Contraseña:</p>
            
                <?php include_once __DIR__ . '/../templates/alertas.php'?>
            
                <form action="/olvide" method="POST" class="formulario">
                    <div class="formulario__campo">
                        <label for="email">Correo:</label>
                        <input 
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Ingresa tu Correo"
                        >
                    </div>
            
                    <input type="submit" value="Enviar Instrucciones" class="formulario__boton">
            
                </form>
            
                <div class="acciones">
                    <a href="/">¿Ya tienes cuenta? <span>Inicia Sesión</span></a>
                    <a href="/registrar">¿Aún no tienes una cuenta? <span>Obtener una</span></a>
                </div>
            
            </div>

        </div>
    </div>
</div>