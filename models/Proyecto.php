<?php

namespace Model;

use Model\ActiveRecord;

class Proyecto extends ActiveRecord {
    public static $tabla = 'proyectos';
    public static $columnasDB = ['id', 'nombre', 'url', 'propietarioId'];

    public $id;
    public $nombre;
    public $url;
    public $propietarioId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['proyecto'] ?? '';
        $this->url = $args['url'] ?? '';
        $this->propietarioId = $args['propietarioId'] ?? '';
    }

    //TODO: - Crear Proyecto

    //! Validacion
    public function validarCrearProyecto() {
    if (!$this->nombre) {
        self::$alertas['error'][] = "Debes añadir un nombre al Proyecto";
    }
    return self::$alertas;
    }

} 