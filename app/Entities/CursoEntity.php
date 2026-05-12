<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class CursoEntity extends Entity
{
    protected $attributes = [
        'idcurso' => null,
        'idestado' => null,
        'idpdestacado' => null,
        'nombre' => null,
        'urlamigable' => null,
        'resumen' => null,
        'contenido' => null,
        'urlimagen' => null,
        'urlbanner' => null,
        'urlbanner2' => null,
        'fecha' => null,
    ];
}
