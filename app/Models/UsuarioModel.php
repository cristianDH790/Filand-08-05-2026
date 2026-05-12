<?php

namespace App\Models;

use App\Entities\UsuarioEntity;
use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuario';
    protected $primaryKey       = 'idusuario';
    protected $useAutoIncrement = true;
    protected $returnType       = UsuarioEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'idestado',
        'idpdocumento',
        'documento',
        'nombres',
        'papellido',
        'sapellido',
        'fechanacimiento',
        'sexo',
        'correo',
        'telefono',
        'login',
        'password',
        'fecha',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function login($login, $clave)
    {
        $usuario = new UsuarioModel();
        $usuario->where('login', $login);
        // $usuario->where('password', $clave);

        $usuario->select("usuario.*, 
        (select parametro.nombre from parametro where parametro.idparametro=usuario.idpdocumento limit 1) as pdocumento");

        return $usuario->first();
    }
    public function autenticar($usuario)
    {
        return $this->where('login', $usuario)
            ->first();
    }
    public function obtenerPorEmail($correo)
    {
        return $this->where('correo', $correo)->first();
    }

    public function obtenerPorCorreo($correo, $idusuario)
    {
        $usuario = new UsuarioModel();
        $usuario->where('correo', $correo);
        if ($idusuario > 0)
            $usuario->where('idusuario', $idusuario);

        return $usuario->first();
    }
    public  function obtenerPorDocumento($documento, $idusuario)
    {
        $usuario = new UsuarioModel();
        $usuario->where('documento', $documento);
        if ($idusuario > 0)
            $usuario->where('idusuario', $idusuario);

        return $usuario->first();
    }

    public function obtenerPorId($idusuario)
    {
        return $this->find($idusuario);
    }

    public function eliminar($idusuario): bool
    {
        $this->db->transStart();
        try {
            if (!$this->where('idusuario', $idusuario)->first()) {
                return false;
            }

            $resultado = $this->delete($idusuario);

            $this->db->transComplete();
            return $resultado;
        } catch (\Throwable $e) {
            $this->db->transRollback();
            log_message('error', 'Eliminar usuario falló: ' . $e->getMessage());
            return false;
        }
    }

    public function guardar($data): int
    {
        $this->db->transStart();
        try {
            if (empty($data['idusuario'])) {
                $this->insert($data);
                $id = $this->getInsertID();
            } else {
                $this->update($data['idusuario'], $data);
                $id = $data['idusuario'];
            }

            $this->db->transComplete();
            return $id;
        } catch (\Throwable $e) {
            $this->db->transRollback();
            log_message('error', 'Error en guardar: ' . $e->getMessage());
            throw $e;
        }
    }



    public function buscarPor($ordencriterio, $ordentipo, $parametro, $valor, $idestado, $inicio, $registros)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');

        // Filtro por búsqueda
        if (!empty($parametro) && !empty($valor)) {
            $builder->like($parametro, trim($valor), 'both');
        }
        // Filtros por ID
        if ($idestado > 0) $builder->where('idestado', $idestado);
     

        
        
        // Ordenamiento
        if (!empty($ordencriterio) && !empty($ordentipo)) $builder->orderBy($ordencriterio, $ordentipo);


        if ($registros > 0) {
            $builder->limit($registros, $inicio);
        }

        return $builder->get()->getResult(UsuarioEntity::class);
    }
    public function buscarPorTotal($parametro, $valor,  $idestado)
    {
        $builder = $this->db->table($this->table);

        // Filtro por búsqueda
        if (!empty($parametro) && !empty($valor)) {
            $builder->like($parametro, trim($valor), 'both');
        }

        //Filtros por ID
        if ($idestado > 0)  $builder->where('idestado', $idestado);
       
   

        return $builder->countAllResults();
    }






 
}
