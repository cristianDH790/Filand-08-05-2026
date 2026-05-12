<?php

namespace App\Models;

use App\Entities\CursoEntity;
use CodeIgniter\Model;

class CursoModel extends Model
{
    protected $table            = 'curso';
    protected $primaryKey       = 'idcurso';
    protected $useAutoIncrement = true;
    protected $returnType       = CursoEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'idestado',
        'idpdestacado',
        'nombre',
        'urlamigable',
        'resumen',
        'contenido',
        'urlimagen',
        'urlbanner',
        'urlbanner2',
        'fecha',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function obtenerPorId($idcurso)
    {
        return $this->where('idcurso', $idcurso)->first();
    }
    public function obtenerPorUrlAmigable($urlamigable)
{
    return $this->where('urlamigable', $urlamigable)->first();
}

    public function eliminar($idcurso): bool
    {
        $this->db->transStart();
        try {
            if (!$this->where('idcurso', $idcurso)->first()) {
                return false;
            }

            $resultado = $this->delete($idcurso);

            $this->db->transComplete();
            return $resultado;
        } catch (\Throwable $e) {
            $this->db->transRollback();
            log_message('error', 'Eliminar curso fallo: ' . $e->getMessage());
            return false;
        }
    }

    public function guardar($data): int
    {
        $this->db->transStart();
        try {
            if (empty($data['idcurso'])) {
                $this->insert($data);
                $id = $this->getInsertID();
            } else {
                $this->update($data['idcurso'], $data);
                $id = $data['idcurso'];
            }

            $this->db->transComplete();
            return $id;
        } catch (\Throwable $e) {
            $this->db->transRollback();
            log_message('error', 'Error en guardar curso: ' . $e->getMessage());
            throw $e;
        }
    }

    public function buscarPor($ordencriterio = '', $ordentipo = '', $parametro = '', $valor = '', $idestado = 0, $idpdestacado = 0, $inicio = 0, $registros = 0)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');

        if (!empty($parametro) && !empty($valor)) {
            $builder->like($parametro, trim($valor), 'both');
        }

        if ($idestado > 0) {
            $builder->where('idestado', $idestado);
        }

        if ($idpdestacado > 0) {
            $builder->where('idpdestacado', $idpdestacado);
        }

        if (!empty($ordencriterio) && !empty($ordentipo)) {
            $builder->orderBy($ordencriterio, $ordentipo);
        }

        if ($registros > 0) {
            $builder->limit($registros, $inicio);
        }

        return $builder->get()->getResult(CursoEntity::class);
    }

    public function buscarPorTotal($parametro = '', $valor = '', $idestado = 0, $idpdestacado = 0)
    {
        $builder = $this->db->table($this->table);

        if (!empty($parametro) && !empty($valor)) {
            $builder->like($parametro, trim($valor), 'both');
        }

        if ($idestado > 0) {
            $builder->where('idestado', $idestado);
        }

        if ($idpdestacado > 0) {
            $builder->where('idpdestacado', $idpdestacado);
        }

        return $builder->countAllResults();
    }
}
