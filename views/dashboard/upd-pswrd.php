<?php
    include_once __DIR__ . '/header-dashboard.php';
?>    

<div class="principal principal__contenedor">

    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <a href="/perfil" class="boton-pswrd">Ir a Perfil</a>

    <form action="/upd-pswrd" class="formulario" method="POST">
        <div class="formulario__campo perfil">
            <label for="password_actual">Contraseña Actual</label>
            <input 
                type="password"
                name="password_actual"   
                placeholder="Ingresa Tu Contraseña Actual" 
            >
        </div>

        <div class="formulario__campo perfil">
            <label for="password_nuevo">Nueva Contraseña</label>
            <input 
                type="password"
                name="password_nuevo"   
                placeholder="Crea Tu Nueva Contraseña" 
            >
        </div>

        <input class="boton-form" type="submit" value="Cambiar Contraseña">
    </form>
</div>

<?php
    include_once __DIR__ . '/footer-dashboard.php';
?>    