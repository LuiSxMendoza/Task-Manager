<?php
    include_once __DIR__ . '/header-dashboard.php';
?>

<div class="principal principal__contenedor">
    <?php  if(count($proyectos) === 0 ) { ?>
        <p class="principal__vacio">No Hay Proyectos Aún :(</p>
        <a href="/crear-proyecto" class="principal__boton">Empieza Ahora</a>
    <?php } else { ?>
        <ul class="principal__lista">
            <?php foreach($proyectos as $proyecto) { ?>
                    <a href="/proyecto?url=<?php echo $proyecto->url; ?>">
                        <li class="principal__proyecto">
                            <?php echo $proyecto->nombre ?>
                        </li>
                    </a>
            <?php } ?>
        </ul>
    <?php } ?>
</div>

<?php
    include_once __DIR__ . '/footer-dashboard.php';
?>