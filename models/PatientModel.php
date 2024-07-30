<?php

namespace app\models;

use app\core\Application;
use app\core\Model;
use DateTime;

class PatientModel extends Model
{
    public string $first_name;
    public string $last_name;
    public string $date_of_birth;
    public string $phone_number;
    public ?bool $active = true;
    public ?DateTime $created_at = null;
    public ?DateTime $released_at = null;


    public function writeAttributes(): array
    {
        return ["first_name", "last_name", "date_of_birth", "phone_number", "active", "created_at", "released_at"];
    }

    public function readAttributes(): array
    {
        return ["first_name", "last_name", "date_of_birth", "phone_number", "active", "created_at", "released_at"];
    }

    public function tableName(): string
    {
        return "patients";
    }

    public function rules(): array
    {
        return [
            'first_name' => [self::RULE_REQUIRED],
            'last_name' => [self::RULE_REQUIRED],
            'date_of_birth' => [self::RULE_REQUIRED],
            'phone_number' => [self::RULE_REQUIRED]
        ];
    }

    public function deactivate()
    {
        $tableName = $this->tableName(); // Dobijamo ime tabele za pacijente

        $queryString = "UPDATE $tableName SET active = 0, released_at = CURRENT_TIMESTAMP WHERE id = {$this->id}";
        $this->query($queryString);

        return false;
    }

}