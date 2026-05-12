<?php

namespace App\Validation;

class CursoValidation
{
    public static function CursoGuardarValidation(array $data): array
    {
        $errors = [];

        if (empty($data['estado']['idEstado'])) {
            $errors[] = ["campo" => "estado", "valor" => "Seleccione el estado."];
        }

        if (empty($data['pDestacado']['idParametro'])) {
            $errors[] = ["campo" => "pDestacado", "valor" => "Seleccione si el curso es destacado."];
        }

        if (empty($data['nombre'])) {
            $errors[] = ["campo" => "nombre", "valor" => "Ingrese el nombre."];
        }

        if (empty($data['urlAmigable'])) {
            $errors[] = ["campo" => "urlAmigable", "valor" => "Ingrese la url amigable."];
        }

        return $errors;
    }

    public static function CursoActualizarValidation(array $data): array
    {
        $errors = [];

        if (empty($data['idCurso'])) {
            $errors[] = ["campo" => "idCurso", "valor" => "Ingrese el curso."];
        }

        if (empty($data['estado']['idEstado'])) {
            $errors[] = ["campo" => "estado", "valor" => "Seleccione el estado."];
        }

        if (empty($data['pDestacado']['idParametro'])) {
            $errors[] = ["campo" => "pDestacado", "valor" => "Seleccione si el curso es destacado."];
        }

        if (empty($data['nombre'])) {
            $errors[] = ["campo" => "nombre", "valor" => "Ingrese el nombre."];
        }

        if (empty($data['urlAmigable'])) {
            $errors[] = ["campo" => "urlAmigable", "valor" => "Ingrese la url amigable."];
        }

        return $errors;
    }
}
