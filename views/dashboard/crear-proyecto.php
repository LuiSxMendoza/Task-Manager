<?php
    include_once __DIR__ . '/header-dashboard.php';
?>   

<div class="principal principal__contenedor">

    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    
    <form action="/crear-proyecto" class="formulario" method="POST">
        <?php include_once __DIR__ . '/../templates/formulario.php'; ?>
    
        <input class="boton-form" type="submit" value="Crear Proyecto">
    </form>
</div>

<?php
    include_once __DIR__ . '/footer-dashboard.php';
?>    
