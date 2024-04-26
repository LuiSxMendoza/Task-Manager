<?php
    include_once __DIR__ . '/header-dashboard.php';
?>   

<div class="principal principal__contenedor">

    <?php foreach ( $alertas as $key => $mensajes ):
            foreach($mensajes as $mensaje):
    ?>
            <div class="alerta <?php echo $key; ?>">
                <?php echo $mensaje; 
                    $page = '/crear-proyecto';
                    //debuguear($_SERVER);
                    $sec = "3";
                    header("Refresh: $sec; url=$page");
                ?>
            </div>
    <?php
            endforeach; 
        endforeach;
    ?>
    
    <form action="/crear-proyecto" class="formulario" method="POST">
        <?php include_once __DIR__ . '/../templates/formulario.php'; ?>
    
        <input class="boton-form" type="submit" value="Crear Proyecto">
    </form>
</div>

<?php
    include_once __DIR__ . '/footer-dashboard.php';
?>    
