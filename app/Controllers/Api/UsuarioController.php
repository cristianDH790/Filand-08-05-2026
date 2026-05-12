<?php

namespace App\Controllers\Api;


use App\Helpers\Excel\ReporteExcelUsuarios;
use App\Helpers\Paginator;
use App\Models\EstadoModel;
use App\Models\ParametroModel;
use App\Models\UsuarioModel;
use App\Transformadores\UsuarioCollectionTransformer;
use App\Transformadores\UsuarioTransformer;
use App\Validation\UsuarioValidation;
use CodeIgniter\RESTful\ResourceController;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UsuarioController extends ResourceController
{
    protected $usuario;
    protected $perfil;
    protected $parametro;
    protected $estado;
    protected $empresa;
    protected $sede;

    public function __construct()
    {
        $this->usuario = new UsuarioModel();
        $this->estado = new EstadoModel();
        $this->parametro = new ParametroModel();
    }

    public  function obtenerPorId($idusuario)
    {
        $usuario = $this->usuario->obtenerPorId($idusuario);
        if (!$usuario) {
            return $this->respond(['mensaje' => 'No existe el usuario solicitado'], 404);
        } else {


            $resultado = UsuarioTransformer::transform($usuario);
            return $this->respond($resultado, 200);
        }
    }
    public function listar()
    {

        $request = $this->request;

        $ordencriterio = $request->getVar('ordenCriterio') ?? 'idusuario';
        $ordentipo = $request->getVar('ordenTipo') ?? 'asc';
        $parametro = $request->getVar('parametro') ?? '';
        $valor = $request->getVar('valor') ?? '';
        $idestado = (int) ($request->getVar('idEstado') ?? 0);


        // Parámetros de paginación
        $pagina = (int) ($request->getVar('pagina') ?? 1);
        $registros = (int) ($request->getVar('registros') ?? 10);

        // Total de registros
        $total = $this->usuario->buscarPorTotal(
            $parametro,
            $valor,
            $idestado
        );

        $paginator = new Paginator($pagina, $registros, $total);

        // Consulta paginada
        $usuarios = $this->usuario->buscarPor(
            $ordencriterio,
            $ordentipo,
            $parametro,
            $valor,
            $idestado,
            $paginator->getFirstElement(),
            $paginator->getSize()
        );

  

        $resultado = UsuarioCollectionTransformer::transform($usuarios);
  
        return $this->respond([
            'paginator' => $paginator->enviar(),
            'content' => $resultado
        ]);
    }
    public function guardar()
    {

        $request = $this->request;

        $data = $request->getJSON(true);
        $usuarioRequest = new UsuarioValidation();
        $errores = $usuarioRequest->UsuarioGuardarValidation($data);

        if (!empty($errores)) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON(['errors' => $errores]);
        }

        $datosValidados = [
            'idestado' => $data['estado']['idEstado'] ?? null,
            'idpdocumento' => $data['pDocumento']['idParametro'] ?? null,
            'documento' => $data['documento'] ?? null,
            'nombres' => $data['nombres'] ?? null,
            'papellido' => $data['pApellido'] ?? null,
            'sapellido' => $data['sApellido'] ?? null,
            'fechanacimiento' => $data['fechaNacimiento'] ?? null,
            'sexo' => $data['sexo'] ?? null,
            'correo' => isset($data['correo']) ? trim($data['correo']) : null,
            'telefono' => $data['telefono'] ?? null,
            'login' => $data['login'] ?? null,
            // 'password' => password_hash($data['password'] ?? null, PASSWORD_DEFAULT),

        ];
        // Solo si viene password válido
        if (!empty($data['password'])) {
            $datosValidados['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $usuarioId = $this->usuario->guardar($datosValidados);
        $usuario = $this->usuario->find($usuarioId);
        if ($usuario) {

            $resultado = UsuarioTransformer::transform($usuario);

            return $this->respond([
                "mensaje" => 'Usuario registrado con éxito',
                "usuario" => $resultado,
            ], 201);
        } else {
            return $this->respond(["mensaje" => "Error al registrar usuario"], 500);
        }
    }

    public function actualizar()
    {
        $request = $this->request;

        $data = $request->getJSON(true);
        $usuarioRequest = new UsuarioValidation();
        $errores = $usuarioRequest->UsuarioActualizarValidation($data);

        if (!empty($errores)) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON(['errors' => $errores]);
        }

        $datosValidados = [
            'idusuario' => $data['idUsuario'] ?? null,
            'idestado' => $data['estado']['idEstado'] ?? null,
            'idpdocumento' => $data['pDocumento']['idParametro'] ?? null,
            'documento' => $data['documento'] ?? null,
            'nombres' => $data['nombres'] ?? null,
            'papellido' => $data['pApellido'] ?? null,
            'sapellido' => $data['sApellido'] ?? null,
            'fechanacimiento' => $data['fechaNacimiento'] ?? null,
            'sexo' => $data['sexo'] ?? null,
            'correo' => isset($data['correo']) ? trim($data['correo']) : null,
            'telefono' => $data['telefono'] ?? null,
            'login' => $data['login'] ?? null,
        ];

        // Solo actualizar contraseña si se envía y no está vacía
        if (!empty($data['password'])) {
            $datosValidados['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $usuarioId = $this->usuario->guardar($datosValidados);
        $usuario = $this->usuario->find($usuarioId);
        if ($usuario) {

            $resultado = UsuarioTransformer::transform($usuario);
            return $this->respond([
                "mensaje" => 'Usuario actualizado con éxito',
                "usuario" => $resultado,
            ], 201);
        } else {
            return $this->respond(["mensaje" => "Error al actualizar usuario"], 500);
        }
    }

    public function eliminar($idusuario)
    {
    
        if ($this->usuario->eliminar($idusuario)) {
            return $this->respond(['mensaje' => 'Usuario eliminado con éxito']);
        } else {
            return $this->failNotFound('No se encontró el usuario');
        }
    }
   
}
