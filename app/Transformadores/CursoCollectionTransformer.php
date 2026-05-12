<?php

namespace App\Transformadores;

use App\Entities\CursoEntity;

class CursoCollectionTransformer
{
    public static function transform($cursos): array
    {
        if ($cursos instanceof CursoEntity) {
            return [CursoTransformer::transform($cursos)];
        }

        if (is_array($cursos)) {
            return array_map(fn($u) => CursoTransformer::transform($u), $cursos);
        }

        return [];
    }
}
