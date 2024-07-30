<?php

namespace app\models;

use app\core\Model;
use DateTime;

class PrescriptionModel extends Model
{
    public int $medicine_id;
    public int $patient_id;
    public int $quantity;

    public DateTime $created_at;

    public function writeAttributes(): array
    {
        return ["medicine_id", "patient_id", "quantity", "created_at"];
    }

    public function readAttributes(): array
    {
        return ["medicine_id", "patient_id", "quantity", "created_at"];
    }

    public function rules(): array
    {
        return [];
    }

    public function tableName(): string
    {
        return "prescriptions";
    }

    public function getAllPrescription()
    {
        $sqlString = "SELECT p.id, m.name AS medicine_name, CONCAT(pat.first_name, ' ', pat.last_name) AS patient_name, p.quantity 
            FROM prescriptions p
            INNER JOIN medicines m ON p.medicine_id = m.id
            INNER JOIN patients pat ON p.patient_id = pat.id";

        $dbResult = $this->query($sqlString);
        return $this->fetchList($dbResult);
    }

}