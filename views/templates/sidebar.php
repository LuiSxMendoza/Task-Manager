<div class="sidebar">
    
    <a href="/index"><h2 class="sidebar__nombre">Task Manager</h2></a>

    <nav class="sidebar__navegacion">
        <a href="/index" class="sidebar__enlaces <?php echo ($titulo === 'Proyectos') ? 'activo' : ''; ?>">
            Proyectos</a>
        <a href="/crear-proyecto" class="sidebar__enlaces <?php echo ($titulo === 'Crear Proyecto') ? 'activo' : ''; ?>">
            Crear Proyecto</a>
        <a href="/perfil" class="sidebar__enlaces <?php echo ($titulo === 'Perfil') ? 'activo' : ''; ?>">
            Perfil</a>
    </nav>

    <?php
        include_once __DIR__ . '/../templates/logo.php'
    ?>

</div>
