<?php 

namespace Classes;

use Exception;
require_once '../vendor/autoload.php';

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarInstruccionesConfirmacion() {
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("juanluis123ar@gmail.com", "UpTask");
        $email->setSubject("Confirma tu cuenta");
        $email->addTo($this->email, 'Cuentas UpTask');

        $email->addContent(
            "text/html", 
            "<p> <strong> Hola " . $this->nombre . " </strong> 
                Has creado tu cuenta en UpTask, solo debes confirmarla haciendo
                clic en el siguiente enlace:
            </p>" .
            "<p> Presiona aquí: <a href='http://localhost:3000/confirma?token=" 
                . $this->token . "'> Confirmar Cuenta </a> </p>" .
            "<p> Si tu no solicitaste esta cuenta puedes ignorar este mensaje </p>" . 
            "<p> ¿Necesitas Ayuda? <a href='https://api.whatsapp.com/send?phone=+7292628462&text=Necesito%20ayuda%20para%20recuperar%20mi%20cuenta'> Contactar a Soporte </a> </p>" 
        );

        $apiKey = $_ENV['API_KEY'];
        $sg = new \SendGrid($apiKey);
        try {
            //$response = 
            $sg->send($email);
            //print $response->statusCode() . "\n";
            //print_r($response->headers());
            //print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }

    public function enviarInstruccionesContraseña() {
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("juanluis123ar@gmail.com", "UpTask");
        $email->setSubject("Cambia tu contraseña");
        $email->addTo($this->email, 'Cuentas UpTask');

        $email->addContent(
            "text/html", 
            "<p> <strong> Hola " . $this->nombre . " </strong> 
                Si tu solicitaste cambiar tu contraseña de UpTask puedes hacerlo haciendo
                clic en el siguiente enlace:
            </p>" .
            "<p> Presiona aquí: <a href='http://localhost:3000/recuperar?token=" 
                . $this->token . "'> Cambiar contraseña </a> </p>" .
            "<p> Si tu no solicitaste esta cambio puedes ignorar este mensaje </p>" . 
            "<p> ¿Necesitas Ayuda? <a href='https://api.whatsapp.com/send?phone=+7292628462&text=Necesito%20ayuda%20para%20recuperar%20mi%20cuenta'> Contactar a Soporte </a> </p>" 
        );

        $apiKey = $_ENV['API_KEY'];
        $sg = new \SendGrid($apiKey);
        try {
            //$response = 
            $sg->send($email);
            //print $response->statusCode() . "\n";
            //print_r($response->headers());
            //print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }

    public function enviarActualizaciónDatos() {
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("juanluis123ar@gmail.com", "UpTask");
        $email->setSubject("Actualizaste tus Datos");
        $email->addTo($this->email, 'Cuentas UpTask');

        $email->addContent(
            "text/html", 
            "<p> <strong> Hola " . $this->nombre . " </strong> 
                Has actualizado tus datos en UpTask, solo debes confirmarlos haciendo
                clic en el siguiente enlace:
            </p>" .
            "<p> Presiona aquí: <a href='http://localhost:3000/confirma?token=" 
                . $this->token . "'> Confirmar Actualización </a> </p>" .
            "<p> Estos cambios se hicieron desde tu perfil, si no los confirmas perderas el acceso a tu cuenta. </p>" . 
            "<p> ¿Necesitas Ayuda? <a href='https://api.whatsapp.com/send?phone=+7292628462&text=Necesito%20ayuda%20para%20recuperar%20mi%20cuenta'> Contactar a Soporte </a> </p>" 
        );

        $apiKey = $_ENV['API_KEY'];
        $sg = new \SendGrid($apiKey);
        try {
            //$response = 
            $sg->send($email);
            //print $response->statusCode() . "\n";
            //print_r($response->headers());
            //print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }

    public function enviarNotificaciónContraseña() {
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("juanluis123ar@gmail.com", "UpTask");
        $email->setSubject("Actualizaste tu Contraseña");
        $email->addTo($this->email, 'Cuentas UpTask');

        $email->addContent(
            "text/html", 
            "<p> <strong> Hola " . $this->nombre . " </strong> 
                Has actualizado tu Contraseña en UpTask.
            </p>" .
            "<p> Si no reconoces estos cambios alguien corrompio tu cuenta. </p>" . 
            "<p> ¿Necesitas Ayuda? <a href='https://api.whatsapp.com/send?phone=+7292628462&text=Necesito%20ayuda%20para%20recuperar%20mi%20cuenta'> Contactar a Soporte </a> </p>" 
        );

        $apiKey = $_ENV['API_KEY'];
        $sg = new \SendGrid($apiKey);
        try {
            //$response = 
            $sg->send($email);
            //print $response->statusCode() . "\n";
            //print_r($response->headers());
            //print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }

    public function enviarNotificaciónConfirmado() {
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("juanluis123ar@gmail.com", "UpTask");
        $email->setSubject("Confirmaste tu Cuenta");
        $email->addTo($this->email, 'Cuentas UpTask');

        $email->addContent(
            "text/html", 
            "<p> <strong> Hola " . $this->nombre . ", </strong> 
                Felicidades! has confirmado tu cuenta de UpTask.
            </p>" .
            "<p> Ahora tienes acceso a todas las funciones de la App Web. </p>" . 
            "<p> ¿Necesitas Ayuda? <a href='https://api.whatsapp.com/send?phone=+7292628462&text=Necesito%20ayuda%20para%20recuperar%20mi%20cuenta'> Contactar a Soporte </a> </p>" 
        );

        $apiKey = $_ENV['API_KEY'];
        $sg = new \SendGrid($apiKey);
        try {
            //$response = 
            $sg->send($email);
            //print $response->statusCode() . "\n";
            //print_r($response->headers());
            //print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }
}