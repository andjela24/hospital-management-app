<?php

namespace app\controllers;

use app\core\Constant;
use app\core\Controller;
use app\models\ReportModel;

class ReportController extends Controller
{

    public function report()
    {
        return $this->view("report", "main", null);
    }

    public function getTotalPatientsPerPeriod()
    {
        $model = new ReportModel();
        $model->mapData($this->request->all());
        $result = $model->getTotalPatientsPerPeriod();
        echo json_encode($result);
    }

    public function getActivePatients()
    {
        $model = new ReportModel();
        $model->mapData($this->request->all());
        $activePatients = $model->getActivePatients();
        echo json_encode($activePatients);
    }

    public function getTotalPrescriptionPerPeriod()
    {
        $model = new ReportModel();
        $model->mapData($this->request->all());
        $result = $model->getTotalPrescriptionPerPeriod();
        echo json_encode($result);
    }

    public function authorizeRoles(): array
    {
        return [
            Constant::$administrator_role
        ];
    }
}