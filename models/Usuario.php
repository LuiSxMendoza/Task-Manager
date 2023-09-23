<?php

namespace Model;

class Usuario extends ActiveRecord {
    //! Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'password',  'token', 'confirmado'];

    public $id;
    public $nombre;
    public $email;
    public $password;
    public $token;
    public $confirmado;
    public $password2;
    public $password_actual;
    public $password_nuevo;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password_actual = $args['password_actual'] ?? '';
        $this->password_nuevo = $args['password_nuevo'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? '0';
    }

    //TODO: - Crear cuenta

    //! Validacion
    public function validarCuentaNueva() {
        if (!$this->nombre) {
            self::$alertas['error'][] = "Debes añadir un Nombre de Usuario";
        }
        if (!$this->email) {
            self::$alertas['error'][] = "Debes añadir un Correo de Usuario";
        }
        if (!$this->password) {
            self::$alertas['error'][] = "Debes añadir una Contraseña para el Usuario";
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = "La Contraseña debe contener al menos
            6 caracteres";
        }
        if ($this->password !== $this->password2) {
            self::$alertas['error'][] = "Las Contraseñas del Usuario no coinciden";
        }
        if(!preg_match('^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})^', $this->email )) {
            self::$alertas['error'][] = "Ingresa un Correo valido";
        }
        return self::$alertas;
    }

    //! Revisa si el usuario existe
    public function existeUsuario() {
        $query = " SELECT * FROM " . self::$tabla . 
        " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado->num_rows) {
            self::$alertas['error'][] = 'El usuario ya esta registrado';
        }
       
        return $resultado;
    }

    //! Hash password
    public function hashPassword() : void {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    //! Crear token 
    public function crearToken() : void {
        $this->token = uniqid();
    }

    //TODO: - Login

    //! Validar
    public function validarLogin() {
        if (!$this->email) {
            self::$alertas['error'][] = "Debes añadir un Correo";
        }
        if (!$this->password) {
            self::$alertas['error'][] = "Debes añadir una Contraseña";
        }
        return self::$alertas;
    }

    //! Comprobar si esta registrado y confirmado
    public function comprobarRegistroAndStatus($password) {

        $resultado = password_verify($password, $this->password);

        if(!$resultado || !$this->confirmado) {
            self::$alertas['error'][] = 'Contraseña incorrecta o cuenta no confirmada';
        } else {
            return true;
        }
    }

    //TODO: - Olvide

    //! Validar
    public function validarEmail() {
        if (!$this->email) {
            self::$alertas['error'][] = "Debes añadir un Correo";
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = "Correo no Válido";
        }
        return self::$alertas;
    }

    //TODO: - Recupera

    //! Validar
    public function validarPassword() {
        if (!$this->password) {
            self::$alertas['error'][] = "Debes añadir una Contraseña";
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = "La Contraseña debe contener al menos
            6 caracteres";
        }
        return self::$alertas;
    }

    //TODO: - Perfil

    //! Validar 
    public function validarPerfil() {
        if (!$this->nombre) {
            self::$alertas['error'][] = "Debes añadir un Nombre al Usuario";
        }
        if (!$this->email) {
            self::$alertas['error'][] = "Debes añadir un Correo al Usuario";
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = "Correo no Valido";
        }
        return self::$alertas;
    }

    public function perfilPassword() : array {
        if (!$this->password_actual) {
            self::$alertas['error'][] = "Añade tu Contraseña Actual";
        }
        if (!$this->password_nuevo) {
            self::$alertas['error'][] = "Añade una nueva Contraseña";
        }
        if(strlen($this->password_nuevo) < 6) {
            self::$alertas['error'][] = "La Contraseña debe contener al menos
            6 caracteres";
        }
        return self::$alertas;
    }

    public function verificarPassword() : bool {
        return password_verify($this->password_actual, $this->password);
    }
}