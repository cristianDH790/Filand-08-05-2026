<?php

namespace App\Controllers\Api\Base;

use App\Models\CursoModel;
use App\Models\SliderModel;
use App\Models\UsuarioModel;
use CodeIgniter\RESTful\ResourceController;

class DashboardController extends ResourceController
{
    public function dashboardStats()
    {
        $usuarioModel = new UsuarioModel();
        $sliderModel = new SliderModel();
        $cursoModel = new CursoModel();

        $meses = [];
        $cursosNuevoMeses = [];

        for ($i = 0; $i <= 11; $i++) {
            $fechaMes = mktime(0, 0, 0, date('m') - $i, 1, date('Y'));
            $mesNumero = date('m', $fechaMes);
            $inicioMes = date('Y-m-01 00:00:00', $fechaMes);
            $finMes = date('Y-m-t 23:59:59', $fechaMes);

            switch ($mesNumero) {
                case '01':
                    $mes = 'Enero';
                    break;
                case '02':
                    $mes = 'Febrero';
                    break;
                case '03':
                    $mes = 'Marzo';
                    break;
                case '04':
                    $mes = 'Abril';
                    break;
                case '05':
                    $mes = 'Mayo';
                    break;
                case '06':
                    $mes = 'Junio';
                    break;
                case '07':
                    $mes = 'Julio';
                    break;
                case '08':
                    $mes = 'Agosto';
                    break;
                case '09':
                    $mes = 'Septiembre';
                    break;
                case '10':
                    $mes = 'Octubre';
                    break;
                case '11':
                    $mes = 'Noviembre';
                    break;
                case '12':
                    $mes = 'Diciembre';
                    break;
            }

            $cursosNuevoMeses[] = $cursoModel
                ->where('fecha >=', $inicioMes)
                ->where('fecha <=', $finMes)
                ->countAllResults();

            $meses[] = $mes;
        }

        return $this->response->setJSON([
            'meses' => array_reverse($meses),
            'totalUsuarios' => $usuarioModel->buscarPorTotal('', '', 0),
            'totalSliders' => $sliderModel->buscarPorTotal('', '', 0, 0, 0),
            'totalCursos' => $cursoModel->buscarPorTotal('', '', 0, 0),
            'cursosNuevoMeses' => array_reverse($cursosNuevoMeses),
        ]);
    }
}
