<?php
    include_once __DIR__ . '/header-dashboard.php';
?>    

<div class="principal principal__contenedor">

    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <a href="/upd-pswrd" class="boton-pswrd">Cambiar Contraseña</a>

    <form action="/perfil" class="formulario" method="POST">
        <div class="formulario__campo">
            <label for="nombre">Nombre</label>
            <input 
                type="text"
                value="<?php echo $usuario->nombre ?>"
                name="nombre"   
                placeholder="Tu Nombre" 
            >
        </div>

        <div class="formulario__campo">
            <label for="email">Correo</label>
            <input 
                type="email"
                value="<?php echo $usuario->email ?>"
                name="email"   
                placeholder="Tu Correo" 
            >
        </div>

        <input class="boton-form" type="submit" value="Actualizar Datos">
    </form>
</div>

<?php
    include_once __DIR__ . '/footer-dashboard.php';
?>    