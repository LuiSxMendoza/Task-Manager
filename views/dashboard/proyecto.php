<?php
    include_once __DIR__ . '/header-dashboard.php';
?> 

    <div class="principal principal__contenedor">

    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    
        <div class="principal__tareas">
            <button 
                class="principal__boton-tareas"
                type="button"
                id="agg-tarea"
            > 
               + Añadir Tarea
            </button>

            <form action="/proyecto" method="POST">
                <input type="hidden" name="id" value="<?php echo $proyectos->id; ?>">
                <input type="submit" class="principal__boton-eliminar" value="Eliminar Proyecto">
            </form>
        </div>

        <div id="filtros" class="filtros">

            <h2 class="filtros__titulo">Filtrar:</h2>

            <div class="filtros__inputs">
                <div class="campo">
                    <label for="todas">Todas</label>
                    <input 
                        type="radio"
                        id="todas"
                        name="filtro"
                        value=""
                        checked
                    >
                </div>

                <div class="campo">
                    <label for="completadas">Completadas</label>
                    <input 
                        type="radio"
                        id="completadas"
                        name="filtro"
                        value="1"
                    >
                </div>

                <div class="campo">
                    <label for="pendientes">Pendientes</label>
                    <input 
                        type="radio"
                        id="pendientes"
                        name="filtro"
                        value="0"
                    >
                </div>
            </div>
        </div>

        <ul class="listado-tareas" id="listado-tareas"></ul>

    </div>

<?php
    include_once __DIR__ . '/footer-dashboard.php';
?>  

<?php
    $script = '
        <script src="build/js/tareas.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.all.min.js"></script>
    '
?>