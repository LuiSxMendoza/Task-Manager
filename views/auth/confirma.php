<div class="auth-bg">
    <div class="pagina confirma pagina__contenedor">
        <?php
            include_once __DIR__ . '/../templates/nombre-sitio.php'
        ?>

        <div class="instrucciones contenedor2">

            <p class="instrucciones__descripcion">¡Confirmaste tu Cuenta!</p>

            <?php foreach ( $alertas as $key => $mensajes ):
                    foreach($mensajes as $mensaje):
            ?>
                    <div class="alerta <?php echo $key; ?>">
                        <?php 
                            echo $mensaje; 
                            $page = $_SERVER['REQUEST_URI'];
                            //debuguear($_SERVER);
                            $sec = "15";
                            header("Refresh: $sec; url=$page");
                        ?>
                    </div>
            <?php
                    endforeach; 
                endforeach;
            ?>

            <a href="/" class="formulario__boton">Ir a Inicio</a>
            
        </div>

        <?php
            include_once __DIR__ . '/../templates/footer.php'
        ?>

    </div>
</div>