<?php

namespace App\Transformadores;

use App\Entities\UsuarioEntity;
use App\Models\EstadoModel;
use App\Models\ParametroModel;
use App\Models\PedidoModel;
use App\Models\PerfilModel;

class UsuarioTransformer
{
    public static function transform(UsuarioEntity $usuario)
    {
        
        return [
            'idUsuario' => (int) $usuario->idusuario,
            'idpDocumento' => (int)$usuario->idpdocumento,
            'documento' => $usuario->documento,
            'nombres'   => $usuario->nombres,
            'pApellido' => $usuario->papellido,
            'sApellido' => $usuario->sapellido,
            'fechaNacimiento' => $usuario->fechanacimiento,
            'sexo' => $usuario->sexo,
            'correo'    => $usuario->correo,
            'telefono'    => $usuario->telefono,
            'boletin'    => $usuario->boletin,
            'login'    => $usuario->login,
         
            'fecha'    => $usuario->fecha,
           
           
            'estado' => $usuario->idestado ? EstadoTransformer::transform((new EstadoModel())->obtenerPorId($usuario->idestado)) : null,
            'pDocumento' => $usuario->idpdocumento ? ParametroTransformer::transform((new ParametroModel())->obtenerPorId($usuario->idpdocumento)) : null,



        ];
    }
}
