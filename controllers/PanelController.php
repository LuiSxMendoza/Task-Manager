<?php

namespace Controllers;

use Classes\Email;
use Model\Proyecto;
use Model\Usuario;
use MVC\Router;

class PanelController {

    public static function index(Router $router) {
        //? Iniciar sesion
        session_start();
        isAuth();

        $id = $_SESSION['id'];

        //? Validar usuario
        $usuario = Usuario::find($_SESSION['id']);

        $proyectos = Proyecto::belongsTo('propietarioId', $id);

        //? Renderizamos vista
        $router->render('dashboard/index', [
            'nombre' => $_SESSION['nombre'],
            'titulo' => 'Proyectos',
            'proyectos' => $proyectos,
            'usuario' => $usuario
        ]);
    }

    public static function crear(Router $router) {
        //? Iniciar sesion
        session_start();
        isAuth();
        $alertas = [];

        //? Validar usuario
        $usuario = Usuario::find($_SESSION['id']);
        //debuguear($_SERVER);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proyecto = new Proyecto($_POST);
            //? Añadimos validacion
            $alertas = $proyecto->validarCrearProyecto();

            if(empty($alertas)) {
                //? Genera URL
                $hash = md5(uniqid());
                $proyecto->url = $hash;

                //? Asignamos creador
                $proyecto->propietarioId = $_SESSION['id'];

                //! Almacenamos en DB
                $proyecto->guardar();

                //? Alerta exito
                Proyecto::setAlerta('exito', 'Proyecto creado Exitosamente');
            } else {
                //? Msj error
                Proyecto::setAlerta('error', 'No se pudo crear el Proyecto');
            }
        }

        //! Mostrar alertas
        $alertas = Proyecto::getAlertas();
        
        //? Renderizamos vista
        $router->render('dashboard/crear-proyecto', [
            'nombre' => $_SESSION['nombre'],
            'titulo' => 'Crear Proyecto',
            'alertas' => $alertas,
            'usuario' => $usuario
        ]);
    }


    public static function proyecto(Router $router) {
        //? Iniciar sesion
        session_start();
        isAuth();
        $alertas = [];

        //? Validar usuario
        $usuario = Usuario::find($_SESSION['id']);

        $token = $_GET['url'];
        if(!$token) header('Location: /index');

        //? Validar usuario y proyectos
        $proyecto = Proyecto::where('url', $token);
        if($proyecto->propietarioId !== $_SESSION['id']) {
            header('Location: /index');
        }

        //! Mostrar alertas
        $alertas = Proyecto::getAlertas();

        //? Renderizamos vista
        $router->render('dashboard/proyecto', [
            'nombre' => $_SESSION['nombre'],
            'titulo' => $proyecto->nombre,
            'proyectos' => $proyecto,
            'alertas' => $alertas,
            'usuario' => $usuario
        ]);
    }

    public static function eliminar () {
        //? Iniciar sesion
        session_start();
        isAuth();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //? Validar que ID's coioncidan
            $id = $_POST['id'];

            //? Buscar proyecto por ID
            $proyecto = Proyecto::find($id);

            //? Eliminar
            $proyecto->eliminar();

            //? Redireccionar
            header('Location: /index');
        }
    }

    public static function perfil(Router $router) {
        //? Iniciar sesion
        session_start();
        isAuth();
        $alertas = [];

        //? Validar usuario
        $usuario = Usuario::find($_SESSION['id']);
        if(!$usuario === $_SESSION['id']) {
            header('Location: /index');
        }
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);

            //? Validar
            $alertas = $usuario->validarPerfil();

            if (empty($alertas)) {
            //? Comprobar E-Mail
            $existeUsuario = Usuario::where('email', $usuario->email);
            //debuguear($_POST);

            if ($existeUsuario && $existeUsuario->id !== $usuario->id) {
                //? Mensaje de error
                Proyecto::setAlerta('error', 'Email ya Registrado');
                } else {
                    //! Guardar Registro
                    //? Crear token
                    $usuario->crearToken();
                    $usuario->confirmado = "0";

                    //? Enviar Email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarActualizaciónDatos();

                    //? Almacenar en la base de datos
                    $usuario = $usuario->guardar();

                    $_SESSION['nombre'] = $usuario->nombre;

                    //? Redireccionar
                    header('Location: /index');
                }
            }
        }
        //! Mostrar alertas
        $alertas = Usuario::getAlertas();

        //? Renderizamos vista
        $router->render('dashboard/perfil', [
            'nombre' => $_SESSION['nombre'],
            'titulo' => 'Perfil',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function updpswrd (Router $router) {
        //? Iniciar sesion
        session_start();
        isAuth();
        $alertas = [];

        //? Validar usuario
        $usuario = Usuario::find($_SESSION['id']);
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //? Validar usuario
            $usuario = Usuario::find($_SESSION['id']);

            //? Sincronizar con datos del usuario
            $usuario->sincronizar($_POST);

            //? Validar
            $alertas = $usuario->perfilPassword();

            if (empty($alertas)) {
                //? Comprobar passwords
                $resultado = $usuario->verificarPassword();

                if ($resultado) {
                    //? Sustituimos passwords
                    $usuario->password = $usuario->password_nuevo;

                    //? Eliminamos password anterior y actual
                    unset($usuario->password_actual);
                    unset($usuario->password_nuevo);
                    
                    //? Hasheamos password
                    $usuario->hashPassword();

                    //? Guardamos password
                    $resultado = $usuario->guardar();

                    //? Enviar Email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarNotificaciónContraseña();

                    if ($resultado) {
                        Proyecto::setAlerta('exito', 'Contraseña Actualizada');
                    }
                } else {
                    //? Mensaje de error
                    Proyecto::setAlerta('error', 'Contraseña Incorrecta');
                }
            }
        }

        //! Mostrar alertas
        $alertas = Usuario::getAlertas();

        //? Renderizamos vista
        $router->render('dashboard/upd-pswrd', [
            'nombre' => $_SESSION['nombre'],
            'titulo' => 'Cambiar Contraseña',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
}
