<div class="auth-bg">
    <div class="pagina confirma">
       <div class="pagina__grid">

            <div class="logo-site">
                <?php
                    include_once __DIR__ . '/../templates/nombre-sitio.php'
                ?>
            </div>
        
            <div class="instrucciones contenedor2">
        
                <p class="titulo2">¡Confirmaste tu Cuenta!</p>
        
                <?php foreach ( $alertas as $key => $mensajes ):
                        foreach($mensajes as $mensaje):
                ?>
                        <div class="alerta <?php echo $key; ?>">
                            <?php 
                                echo $mensaje; 
                                $page = '/';
                                //debuguear($_SERVER);
                                $sec = "10";
                                header("Refresh: $sec; url=$page");
                            ?>
                        </div>
                <?php
                        endforeach; 
                    endforeach;
                ?>
        
                <a href="/" class="formulario__boton">Ir a Inicio</a>
                
            </div>
       </div>
    </div>
</div>