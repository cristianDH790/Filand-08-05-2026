<?php

namespace App\Controllers\Api\Auth;

use App\Controllers\BaseController;
use App\Entities\EmpresaEntity;
use App\Entities\UsuarioEntity;
use App\Helpers\Util;
use App\Models\EmpresaModel;
use App\Models\EstadoModel;
use App\Models\MensajeModel;
use App\Models\OpcionModel;
use App\Models\ParametroModel;
use App\Models\PerfilModel;
use App\Models\UsuarioModel;
use App\Transformadores\UsuarioTransformer;
use Firebase\JWT\JWT;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\Key;

class AuthController extends ResourceController
{
    protected $usuario;
    protected $mensaje;
    protected $parametro;
    protected $estado;
    protected $empresa;
    protected $opcion;


    public function __construct()
    {
        $this->usuario = new UsuarioModel();
        $this->parametro = new ParametroModel();
        $this->estado = new EstadoModel();
    }
    public function login()
    {
        $username = $this->request->getVar('login');
        $password = $this->request->getVar('password');


        $user = $this->usuario->autenticar($username);
        if ($user &&  password_verify($password, $user->password)) {
            unset($user->password);

            $key = getenv('JWT_SECRET');

            $resultado = UsuarioTransformer::transform($user);

            $payload = [
                'sub' => $user->idusuario,
                'usuario' => $resultado,
                'iat' => time(), // Tiempo que se creo el token
                'nbf' => time(), // Tiempo que empieza a ser valido
                'exp' => time() + 3600, // Tiempo de expiracion
            ];

            $token = JWT::encode($payload, $key, 'HS256');
            return $this->respond([
                // 'message' => 'Bienvenido usuario ' . $resultado['nombres'],
                'token' => $token
            ]);
        } else {

            return $this->fail('Credenciales inválidas', 400);

            // return $this->failUnauthorized('Credenciales inválidas');
        }
    }

    public function pass()
    {
        $passwordPlano = 'admin';
        $hash = password_hash($passwordPlano, PASSWORD_DEFAULT);
        return $this->respond(['admin12' => $hash]);
    }
    // Prueba rápida en otro controlador o ruta simple
    public function testHash()
    {
        $passwordPlano = 'admin';
        $hash = password_hash($passwordPlano, PASSWORD_DEFAULT);
        return $this->response->setJSON(['admin12' => $hash]);
    }
    public function permisos()
    {
        //aqui capturo el token del usuario
        $authorizationHeader = $this->request->getHeaderLine('X-Authorization');
        if (!$authorizationHeader) {
            return $this->failUnauthorized('Token no proporcionado');
        }
        $token = str_replace('Bearer ', '', $authorizationHeader);
        if (!$token) {
            return $this->failUnauthorized('Token no proporcionado');
        }
        try {
            $key = getenv('JWT_SECRET');
            $decoded = JWT::decode($token, new Key($key, 'HS256'));

            $userId = $decoded->sub;

            // Obtener los permisos del usuario
            $permisos = $this->opcion->listarCodigosPorUsuario($userId);

            return $this->respond(['authorities' => $permisos]);
        } catch (\Exception $e) {
            return $this->failUnauthorized('Token inválido: ' . $e->getMessage());
        }
    }

    public function recuperarClave()
    {
        helper('text'); // Por si usas random_string() en lugar de generarCodigo()

        $correo = $this->request->getVar('correo');

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            return $this->respond([
                'status'  => 'error',
                'mensaje' => 'Correo electrónico inválido'
            ], 400);
        }

        $usuario = $this->usuario->obtenerPorEmail($correo);

        if (!$usuario) {
            return $this->respond([
                'status'  => 'error',
                'mensaje' => 'Correo no encontrado en el sistema'
            ], 404);
        }

        // Generar nueva clave y actualizar

        $util = new Util();
        $nuevaClave = $util::generatePassword(8);
        $hash = password_hash(trim($nuevaClave), PASSWORD_DEFAULT);

        $this->usuario->guardar([
            'idusuario' => $usuario->idusuario,
            'password'     => $hash,
        ]);

        // Obtener plantilla del mensaje
        $mensaje = "
        <h2>Recuperación de contraseña</h2>

<p>Hola <strong>#1</strong>,</p>

<p>Has recuperado exitosamente tu contraseña de acceso.</p>

<p>Tus nuevos datos de ingreso son:</p>

<ul>
    <li><strong>Usuario:</strong> #2</li>
    <li><strong>Nueva contraseña:</strong> #3</li>
</ul>

<p>Te recomendamos iniciar sesión y cambiar tu contraseña por una más segura.</p>

<p>Saludos cordiales.</p>
        "; // Plantilla de email


        // Personalizar contenido
        $contenido = $mensaje;

        $reemplazos = [
            '#1' => $usuario->nombres . " " . $usuario->papellido . " " . $usuario->sapellido,
            '#2' => $usuario->login,
            '#3' => $nuevaClave
        ];

        $contenidoFinal = strtr($contenido, $reemplazos);

        // Enviar email
        $email = \Config\Services::email();
        $email->setFrom('no-reply@finlandinstitute.com', 'Finland - Institute'); // ✅ requerido
        $email->setTo($correo);
        $email->setCC('');
        $email->setSubject("RECUPERAR CONTRASEÑA");
        $email->setMessage($contenidoFinal); // Si es HTML, puedes usar setMessage() con HTML MIME

        if ($email->send()) {
            return $this->respond([
                'status'  => 'success',
                'mensaje' => 'Correo enviado correctamente'
            ], 200);
        } else {
            log_message('error', print_r($email->printDebugger(['headers', 'subject', 'body']), true));
            return $this->respond([
                'status'  => 'error',
                'mensaje' => 'Error al enviar el correo'
            ], 500);
        }
    }
    // private function generarCodigo($length = 8)
    // {
    //     return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
    // }
}
