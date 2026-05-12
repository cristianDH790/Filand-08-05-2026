<?php

namespace App\Controllers\Api;

use App\Helpers\Paginator;
use App\Helpers\Util;
use App\Models\CursoModel;
use App\Models\EstadoModel;
use App\Models\ParametroModel;
use App\Transformadores\CursoCollectionTransformer;
use App\Transformadores\CursoTransformer;
use App\Validation\CursoValidation;
use CodeIgniter\RESTful\ResourceController;

class CursoController extends ResourceController
{
    protected $curso;
    protected $estado;
    protected $parametro;

    public function __construct()
    {
        $this->curso = new CursoModel();
        $this->estado = new EstadoModel();
        $this->parametro = new ParametroModel();
    }

    public function obtenerPorId($idcurso)
    {
        $curso = $this->curso->obtenerPorId($idcurso);

        if (!$curso) {
            return $this->respond(['mensaje' => 'No existe el curso solicitado'], 404);
        } else {
            $resultado = CursoTransformer::transform($curso);
            return $this->respond($resultado, 200);
        }
    }

    public function listar()
    {
        if (!$this->request->is('post')) {
            return $this->fail('Metodo no permitido. Se requiere POST.', 405);
        }

        $request = $this->request;

        $ordencriterio = $request->getVar('ordenCriterio') ?? 'fecha';
        $ordentipo = $request->getVar('ordenTipo') ?? 'asc';
        $parametro = $request->getVar('parametro') ?? '';
        $valor = $request->getVar('valor') ?? '';
        $idestado = (int) ($request->getVar('idEstado') ?? 0);
        $idpdestacado = (int) ($request->getVar('idpDestacado') ?? 0);

        $pagina = (int) ($request->getVar('pagina') ?? 1);
        $registros = (int) ($request->getVar('registros') ?? 10);

        $total = $this->curso->buscarPorTotal(
            $parametro,
            $valor,
            $idestado,
            $idpdestacado
        );

        $paginator = new Paginator($pagina, $registros, $total);

        $cursos = $this->curso->buscarPor(
            $ordencriterio,
            $ordentipo,
            $parametro,
            $valor,
            $idestado,
            $idpdestacado,
            $paginator->getFirstElement(),
            $paginator->getSize()
        );

        $resultado = CursoCollectionTransformer::transform($cursos);

        return $this->respond([
            'paginator' => $paginator->enviar(),
            'content' => $resultado
        ]);
    }

    public function guardar()
    {
        $request = $this->request;

        $data = $request->getJSON(true);
        $cursoRequest = new CursoValidation();
        $errores = $cursoRequest->CursoGuardarValidation($data);

        if (!empty($errores)) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON(['errors' => $errores]);
        }

        $datosValidados = [
            'idestado' => $data['estado']['idEstado'] ?? null,
            'idpdestacado' => $data['pDestacado']['idParametro'] ?? null,
            'nombre' => $data['nombre'] ?? null,
            'urlamigable' => $data['urlAmigable'] ?? null,
            'resumen' => $data['resumen'] ?? null,
            'contenido' => $data['contenido'] ?? null,
            
        ];

        $cursoId = $this->curso->guardar($datosValidados);
        $curso = $this->curso->find($cursoId);

        if ($curso) {
            $resultado = CursoTransformer::transform($curso);
            return $this->respond([
                "mensaje" => 'Curso registrado con exito',
                "curso" => $resultado
            ], 201);
        } else {
            return $this->respond(["mensaje" => "Error al registrar curso"], 500);
        }
    }

    public function actualizar()
    {
        $request = $this->request;

        $data = $request->getJSON(true);
        $cursoRequest = new CursoValidation();
        $errores = $cursoRequest->CursoActualizarValidation($data);

        if (!empty($errores)) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON(['errors' => $errores]);
        }

        $datosValidados = [
            'idcurso' => (int) ($data['idCurso'] ?? null),
            'idestado' => $data['estado']['idEstado'] ?? null,
            'idpdestacado' => $data['pDestacado']['idParametro'] ?? null,
            'nombre' => $data['nombre'] ?? null,
            'urlamigable' => $data['urlAmigable'] ?? null,
            'resumen' => $data['resumen'] ?? null,
            'contenido' => $data['contenido'] ?? null,
            
        ];

        $cursoId = $this->curso->guardar($datosValidados);
        $curso = $this->curso->find($cursoId);

        if ($curso) {
            $resultado = CursoTransformer::transform($curso);
            return $this->respond([
                "mensaje" => 'Curso actualizado con exito',
                "curso" => $resultado
            ], 201);
        } else {
            return $this->respond(["mensaje" => "Error al actualizar el curso"], 500);
        }
    }

    public function eliminar($idcurso)
    {
        if ($this->curso->eliminar($idcurso)) {
            return $this->respond(['mensaje' => 'Curso eliminado con exito']);
        } else {
            return $this->failNotFound('No se encontro el curso');
        }
    }

    public function uploadImagen()
    {
        return $this->uploadArchivoImagen('urlimagen', 'imagen');
    }

    public function uploadBanner()
    {
        return $this->uploadArchivoImagen('urlbanner', 'banner');
    }

    public function uploadBanner2()
    {
        return $this->uploadArchivoImagen('urlbanner2', 'banner2');
    }

    private function uploadArchivoImagen($campo, $tipo)
    {
        $idcurso = $this->request->getPost('idCurso');

        if (!$idcurso) {
            return $this->response->setJSON([
                'mensaje' => 'idCurso es obligatorio'
            ])->setStatusCode(400);
        }

        $curso = $this->curso->find($idcurso);

        if (!$curso) {
            return $this->response->setJSON([
                "mensaje" => "No existe el curso solicitado"
            ])->setStatusCode(404);
        }

        $file = $this->request->getFile('archivo');

        if (!$file || !$file->isValid()) {
            return $this->response->setJSON([
                "mensaje" => "No se recibio archivo valido"
            ])->setStatusCode(400);
        }

        if (!empty($curso->$campo)) {
            $imgPath = FCPATH . env('URL_IMAGE') . '/curso/' . $curso->$campo;
            if (file_exists($imgPath)) {
                unlink($imgPath);
            }
        }

        $nombre = trim($curso->urlamigable ?? $curso->nombre ?? 'curso');
        $urlamigable = Util::urls_amigables($nombre);
        $sufijoUnico = date('YmdHis') . '-' . bin2hex(random_bytes(4));
        $nombrearchivo = $idcurso . '-' . $urlamigable . '-' . $tipo . '-' . $sufijoUnico .'.'. time() . '.' . $file->getExtension();

        $destino = FCPATH . env('URL_IMAGE') . '/curso';
        if (!is_dir($destino)) {
            mkdir($destino, 0777, true);
        }

        $file->move($destino, $nombrearchivo);

        $this->curso->update($idcurso, [
            $campo => $nombrearchivo
        ]);

        $cursoActualizado = $this->curso->find($idcurso);

        return $this->response->setJSON([
            "curso" => CursoTransformer::transform($cursoActualizado),
            "mensaje" => "Imagen cargada con exito"
        ])->setStatusCode(200);
    }

    public function eliminarImagen()
    {
        $data = $this->request->getJSON(true);

        $idcurso = $data['idCurso'] ?? null;
        $tipo = $data['tipo'] ?? null;

        if (empty($idcurso)) {
            return $this->response->setJSON(['errors' => ['ID de curso no recibido']])->setStatusCode(400);
        }

        $curso = $this->curso->find($idcurso);
        if (!$curso) {
            return $this->response->setJSON(['errors' => ['No existe el curso solicitado']])->setStatusCode(404);
        }

        $camposPermitidos = ['urlimagen', 'urlbanner', 'urlbanner2'];
        $campo = in_array($tipo, $camposPermitidos) ? $tipo : 'urlimagen';
        $urlimagen = $curso->$campo ?? null;

        $imgPath = FCPATH . env('URL_IMAGE') . '/curso/' . $urlimagen;
        if (!empty($urlimagen) && file_exists($imgPath)) {
            unlink($imgPath);
        }

        $this->curso->update($idcurso, [$campo => null]);

        $cursoActualizado = $this->curso->find($idcurso);
        $resultado = CursoTransformer::transform($cursoActualizado);

        return $this->response->setJSON([
            "curso" => $resultado,
            "mensaje" => "Imagen eliminada con exito"
        ])->setStatusCode(200);
    }
}
