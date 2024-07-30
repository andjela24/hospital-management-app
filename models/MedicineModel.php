<?php

namespace app\models;

use app\core\Model;

class MedicineModel extends Model
{
    public string $name;
    public string $manufacturer;

    public string $image_path;

    public function writeAttributes(): array
    {
        return ["name", "manufacturer", "image_path"];
    }

    public function readAttributes(): array
    {
        return ["id", "name", "manufacturer", "image_path"];
    }

    public function tableName(): string
    {
        return "medicines";
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'manufacturer' => [self::RULE_REQUIRED],
            'image_path' => [self::RULE_REQUIRED]
        ];
    }
}