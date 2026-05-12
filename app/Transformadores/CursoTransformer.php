<?php

namespace App\Transformadores;

use App\Entities\CursoEntity;
use App\Models\EstadoModel;
use App\Models\ParametroModel;

class CursoTransformer
{
    public static function transform(CursoEntity $curso)
    {
        return [
            'idCurso' => (int) $curso->idcurso,
            'idEstado' => (int) $curso->idestado,
            'idpDestacado' => (int) $curso->idpdestacado,
            'nombre' => $curso->nombre,
            'urlAmigable' => $curso->urlamigable,
            'resumen' => $curso->resumen,
            'contenido' => $curso->contenido,
            'urlImagen' => $curso->urlimagen,
            'urlBanner' => $curso->urlbanner,
            'urlBanner2' => $curso->urlbanner2,
            'fecha' => $curso->fecha,

            'estado' => $curso->idestado ? EstadoTransformer::transform((new EstadoModel())->obtenerPorId($curso->idestado)) : null,
            'pDestacado' => $curso->idpdestacado ? ParametroTransformer::transform((new ParametroModel())->obtenerPorId($curso->idpdestacado)) : null,
        ];
    }
}
