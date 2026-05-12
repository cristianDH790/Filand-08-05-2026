<?php

namespace App\Controllers;

use App\Models\ConfiguracionModel;
use App\Models\MensajeModel;
use App\Models\SuscripcionModel;
use App\Models\UsuarioModel;
use Config\Services;
use Dompdf\Dompdf;

class FormularioController extends BaseController
{
    protected $suscripcion;
    protected $session;

    private $email;
    protected $mailFromEmail;
    protected $mailFromName;

    public function __construct()
    {
        date_default_timezone_set('America/Lima');

        $this->session = \Config\Services::session();
        $this->email = Services::email();
        $this->mailFromName = env('MAIL_FROM_NAME');
        $this->mailFromEmail = env('MAIL_FROM_EMAIL');
    }

    public function mailContacto()
    {
        $nombres = $this->request->getPost("nombres");
        $correo = $this->request->getPost("correo");
        $telefono = $this->request->getPost("telefono");
        $asunto = $this->request->getPost("asunto");
        $mensaje = $this->request->getPost("mensaje");

        $captchacheck = $_SESSION['captcha_text'];
        $captcha = strtoupper($this->request->getPost("captcha"));

        $data = [];

        // VALIDACIONES
        if (empty($nombres)) $data[] = ['campo' => 'nombres', 'valor' => 'Complete'];
        if (empty($correo)) $data[] = ['campo' => 'correo', 'valor' => 'Complete'];
        if (empty($telefono)) $data[] = ['campo' => 'telefono', 'valor' => 'Complete'];
        if (empty($asunto)) $data[] = ['campo' => 'asunto', 'valor' => 'Complete'];

        if (empty($captcha)) {
            $data[] = ['campo' => 'captcha', 'valor' => 'Complete el captcha'];
        } elseif ($captcha != $captchacheck) {
            $data[] = ['campo' => 'captcha', 'valor' => 'Captcha incorrecto'];
        }

        if (count($data) > 0) {
            return $this->response->setJSON(["errors" => $data, "status" => "error"]);
        }

        // CONTENIDO DEL CORREO
        $contenido  = "
    <div style='max-width:600px;margin:auto;font-family:Arial;border:1px solid #ddd;padding:20px;border-radius:10px;'>
        <h2>Nuevo mensaje de contacto</h2>

        <p><strong>Nombre:</strong> {$nombres}</p>
        <p><strong>Correo:</strong> {$correo}</p>
        <p><strong>Telefono:</strong> {$telefono}</p>
        <p><strong>Asunto:</strong> {$asunto}</p>";

        if (!empty($mensaje)) {
            $contenido .= "<p><strong>Mensaje:</strong><br>{$mensaje}</p>";
        }

        $contenido .= "
        <hr>
        <p style='font-size:12px;color:#777;'>Fecha: " . date('d-m-Y H:i:s') . "</p>
    </div>";

        // ARRAY DE CORREOS
        $correoEnvio = [
            'contacto@finlandinstitute.com'
           
        ];

        $enviado = false;
        $errores = [];

        foreach ($correoEnvio as $correoDestino) {
            $this->email->clear(true);
            $this->email->initialize([
                'SMTPDebug' => 2
            ]);
            $this->email->setFrom($this->mailFromEmail, $this->mailFromName);
            $this->email->setTo(trim($correoDestino));
            $this->email->setSubject($asunto);
            $this->email->setMessage($contenido);

            $resultado = $this->email->send(false);

            if ($resultado) {
                $enviado = true;
                log_message('info', 'Enviado a: ' . $correoDestino);
            } else {
                $debug = $this->email->printDebugger(['headers', 'subject', 'body']);
                $errores[] = $debug;
                log_message('error', $debug);
            }
        }

        if ($enviado) {
            return $this->response->setJSON([
                "status" => "exito"
            ]);
        }

        return $this->response->setJSON([
            "status" => "error",
            "mensaje" => "No se pudo enviar",
            "debug" => $errores
        ]);
    }

    public function mailMatricula()
    {
        $languages = $this->request->getPost("languages") ?? [];
        $prospects = $this->request->getPost("prospects") ?? [];
        $interest = $this->request->getPost("interest") ?? [];
        $branding = $this->request->getPost("branding") ?? [];
        $policy = $this->request->getPost("policy");

        $captchacheck = $_SESSION['captcha_text'];
        $captcha = strtoupper($this->request->getPost("captcha"));

        $data = [];

        // VALIDACIONES
        if (empty($languages)) $data[] = ['campo' => 'languages', 'valor' => 'Seleccione al menos un idioma'];
        if (empty($prospects['names'])) $data[] = ['campo' => 'prospects_names', 'valor' => 'Complete'];
        if (empty($prospects['firstlastename'])) $data[] = ['campo' => 'prospects_firstlastename', 'valor' => 'Complete'];
        if (empty($prospects['secondlastename'])) $data[] = ['campo' => 'prospects_secondlastename', 'valor' => 'Complete'];
        if (empty($prospects['documentnumber'])) $data[] = ['campo' => 'prospects_documentnumber', 'valor' => 'Complete'];
        if (empty($prospects['email'])) {
            $data[] = ['campo' => 'prospects_email', 'valor' => 'Complete'];
        } elseif (!filter_var($prospects['email'], FILTER_VALIDATE_EMAIL)) {
            $data[] = ['campo' => 'prospects_email', 'valor' => 'Correo invalido'];
        }
        if (empty($prospects['levellanguages'])) $data[] = ['campo' => 'prospects_levellanguages', 'valor' => 'Seleccione'];
        if (empty($policy)) $data[] = ['campo' => 'policy', 'valor' => 'Debe aceptar las politicas y privacidad'];

        if (empty($captcha)) {
            $data[] = ['campo' => 'captcha', 'valor' => 'Complete el captcha'];
        } elseif ($captcha != $captchacheck) {
            $data[] = ['campo' => 'captcha', 'valor' => 'Captcha incorrecto'];
        }

        if (count($data) > 0) {
            return $this->response->setJSON(["errors" => $data, "status" => "error"]);
        }

        $safe = static function ($value) {
            return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
        };

        $languagesText = implode(', ', array_map($safe, $languages));
        $interestText = !empty($interest) ? implode(', ', array_map($safe, $interest)) : 'No indicado';
        $brandingText = !empty($branding) ? implode(', ', array_map($safe, $branding)) : 'No indicado';
        $telephone = !empty($prospects['telephone']) ? $safe($prospects['telephone']) : 'No indicado';

        // CONTENIDO DEL CORREO
        $contenido  = "
    <div style='max-width:600px;margin:auto;font-family:Arial;border:1px solid #ddd;padding:20px;border-radius:10px;'>
        <h2>Nueva solicitud de matricula</h2>

        <p><strong>Idiomas de interes:</strong> {$languagesText}</p>
        <p><strong>Nombres:</strong> " . $safe($prospects['names']) . "</p>
        <p><strong>Apellido paterno:</strong> " . $safe($prospects['firstlastename']) . "</p>
        <p><strong>Apellido materno:</strong> " . $safe($prospects['secondlastename']) . "</p>
        <p><strong>DNI/Pasaporte:</strong> " . $safe($prospects['documentnumber']) . "</p>
        <p><strong>Telefono:</strong> {$telephone}</p>
        <p><strong>Correo:</strong> " . $safe($prospects['email']) . "</p>
        <p><strong>Nivel de idioma actual:</strong> " . $safe($prospects['levellanguages']) . "</p>
        <p><strong>Interes por el idioma:</strong> {$interestText}</p>
        <p><strong>Como encontro nuestro centro:</strong> {$brandingText}</p>
        <p><strong>Politicas y privacidad:</strong> Aceptadas</p>";

        $contenido .= "
        <hr>
        <p style='font-size:12px;color:#777;'>Fecha: " . date('d-m-Y H:i:s') . "</p>
    </div>";

        // ARRAY DE CORREOS
        $correoEnvio = [
            'contacto@finlandinstitute.com'
            
        ];

        foreach ($correoEnvio as $key => $correoDestino) {
            $correoDestino = trim($correoDestino);

            if (empty($correoDestino)) {
                log_message('warning', "Correo vacio en indice {$key}");
                continue;
            }

            $this->email->setFrom($this->mailFromEmail, $this->mailFromName);
            $this->email->setTo($correoDestino);
            $this->email->setSubject('Nueva solicitud de matricula');
            $this->email->setMessage($contenido);

            if ($this->email->send()) {
                log_message('info', "Correo enviado a: {$correoDestino}");
            } else {
                log_message('error', "Error al enviar a: {$correoDestino}");
                log_message('debug', $this->email->printDebugger(['headers']));
            }
        }

        return $this->response->setJSON([
            "status" => "exito"
        ]);
    }

    public function reemplazo($valor1, $valor2, $cadena)
    {
        return str_replace($valor1, $valor2, $cadena);
    }
}
