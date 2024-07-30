<?php

namespace app\models;

use app\core\Model;

class ReportModel extends Model
{
    public string $dateFrom;
    public string $dateTo;

    public function writeAttributes(): array
    {
        return [];
    }

    public function readAttributes(): array
    {
        return [];
    }

    public function rules(): array
    {
        return [];
    }

    public function tableName(): string
    {
        return "";
    }
    public function getTotalPatientsPerPeriod()
    {
        $sql = "SELECT COUNT(*) AS total_patients FROM patients WHERE created_at BETWEEN '$this->dateFrom' AND '$this->dateTo'";
        $result = $this->query($sql);
        return $this->fetchList($result);
    }

    public function getActivePatients()
    {
        $sql = "SELECT * FROM patients WHERE active = 1";
        $result = $this->query($sql);
        return $this->fetchList($result);
    }

    public function getTotalPrescriptionPerPeriod()
    {
        $sql = "SELECT COUNT(*) AS total_prescriptions FROM prescriptions WHERE created_at BETWEEN '$this->dateFrom' AND '$this->dateTo'";
        $result = $this->query($sql);
        return $this->fetchList($result);
    }

}