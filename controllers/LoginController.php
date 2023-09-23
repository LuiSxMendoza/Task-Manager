<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {

    public static function login(Router $router) {
        
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            //? Añadimos validacion
            
            $alertas = $auth->validarLogin();

            //? Escuchamos por alertas vacias
            if(empty($alertas)) {
                //? Comprobamos usuario
                $usuario = Usuario::where('email', $auth->email);
                if ($usuario) {
                    if ($usuario->comprobarRegistroAndStatus($auth->password)) {
                        //? Autenticar usuario
                        session_start();

                        //? Crear instancia de Usuario
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        //? Redireccionar
                        header('Location: /index');
                    }
                }
                else {
                    //? Msj error
                    Usuario::setAlerta('error', 'Usuario no existente');
                }
            }
        }

        //! Mostrar alertas
        $alertas = Usuario::getAlertas();

        //? Renderizamos vista
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión',
            'alertas' => $alertas
        ]);
    }

    public static function logout() {

        session_start();

        $_SESSION = [];

        header('Location: /');
    }

    public static function olvide(Router $router) {

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);

            //? Añadir validacion
            $alertas = $auth->validarEmail();

            if (empty($alertas)) {
            //? Comprobar usuario
            $usuario = Usuario::where('email', $auth->email);
                //? Comprobar confirmado
                if ($usuario && $usuario->confirmado === '1') {
                    //? Enviar token
                    $usuario->crearToken();
                    //? Almacenar en BD
                    $usuario->guardar();
                    //? Enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstruccionesContraseña();
                    //? Alerta exito
                    Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu email');

                } else {
                    //? Msj error
                    Usuario::setAlerta('error', 'Usuario no existente o no confirmado');
                }
            }
        }

        //! Mostrar alertas
        $alertas = Usuario::getAlertas();

        $router->render('auth/olvide', [
            'titulo' => 'Olvide Contraseña',
            'alertas' => $alertas
        ]);
    }

    public static function recuperar(Router $router) {

        //? Añadir arreglo de alertas vacias
        $alertas = [];
        $error = false;

        //? Buscar token
        $token = s($_GET['token']);

        //? Buscar usuario por token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            //? Mostrar msj de error
            Usuario::setAlerta('error', 'Token NO Valido');
            $error = true;

        } if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $password = new Usuario($_POST);

            //? Añadir validacion
            $alertas = $password->validarPassword();

            if(empty($alertas)) {
                //? Eliminamos password antiguo
                $usuario->password = null;

                //? Leemos nuevo password
                $usuario->password = $password->password;

                //? Hash password
                $usuario->hashPassword();

                //? Guardar en bd y eliminar token
                $usuario->token = null;
                $resultado = $usuario->guardar();

                //? Enviar email
                $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                $email->enviarNotificaciónContraseña();

                //? Redireccionar
                if($resultado) {
                    //? Msj de exito
                    Usuario::setAlerta('exito', 'Contraseña actualizada correctamente');
                }
            }
        }

        //! Mostrar alertas
        $alertas = Usuario::getAlertas();

        $router->render('auth/recupera', [
            'titulo' => 'Recuperar Cuenta',
            'alertas' => $alertas,
            'error' => $error
        ]);
    }

    public static function registrar(Router $router) {

        $usuario = new Usuario;

        //? Alertas vacias
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarCuentaNueva();

            if (empty($alertas)) {
                $resultado = $usuario->existeUsuario();

                if ($resultado->num_rows) {
                } else {
                    //? Hashear password
                    $usuario->hashPassword();
                    unset($usuario->password2);

                    //? Crear token
                    $usuario->crearToken();

                    //? Almacenar en la base de datos
                    $resultado = $usuario->guardar();

                    //? Enviar Email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstruccionesConfirmacion();

                    if($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }

        //! Mostrar alertas
        $alertas = Usuario::getAlertas();

        $router->render('auth/registrar', [
            'titulo' => 'Registrar Usuario',
            'alertas' => $alertas,
            'usuario' => $usuario
        ]);
    }

    public static function confirma(Router $router) {

        $alertas = [];

        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            //? Mostrar msj de error
            Usuario::setAlerta('error', 'Token NO Valido');
        } else {
            //? Confirmar usuario
            $usuario->confirmado = "1";

            $usuario->token = null;
            
            $usuario->guardar();
            
            //? Enviar Email
            $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
            $email->enviarNotificaciónConfirmado();

            Usuario::setAlerta('exito', 'Cuenta confirmada correctamente');
        }

        //! Mostrar alertas
        $alertas = Usuario::getAlertas();

        $router->render('auth/confirma', [
            'titulo' => 'Confirma Cuenta de UpTask',
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router) {

        $alertas = [];

        $router->render('auth/mensaje', [
            'titulo' => 'Cuenta Creada Correctamente',
            'alertas' => $alertas
        ]);
    }
}