<?php

namespace app\core;

use DateTime;

abstract class Model extends DbConnection
{
    public int $id;

    public $errors;
    public const RULE_EMAIL = 'email';
    public const RULE_REQUIRED = 'required';
    public const RULE_BOOL = 'bool';
    public const RULE_NUMBER = 'number';

    abstract public function writeAttributes(): array;

    abstract public function readAttributes(): array;

    abstract public function rules(): array;

    abstract public function tableName(): string;

    /**
     * @throws \Exception
     */
    public function mapData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                if ($value === null && $key === 'released_at') {
                    $this->{$key} = null;
                } elseif ($key === 'created_at' || $key === 'released_at') {
                    if ($value instanceof DateTime || $value === null) {
                        $this->{$key} = $value;
                    } elseif (is_string($value)) {
                        $this->{$key} = new DateTime($value);
                    }
                } else {
                    $this->{$key} = $value;
                }
            }
        }
    }

    public function create()
    {
        $tableName = $this->tableName();
        $attributes = $this->writeAttributes();
        $attributesHelper = array_map(fn($attr) => ":$attr", $attributes);

        $sqlString = "INSERT INTO $tableName (" . implode(',', $attributes) . ") VALUES (" . implode(',', $attributesHelper) . ")";

        foreach ($attributes as $attribute) {
            if ($attribute === 'created_at' && $this->{$attribute} instanceof DateTime) {
                $sqlString = str_replace(":$attribute", "'" . $this->{$attribute}->format('Y-m-d H:i:s') . "'", $sqlString);
            } elseif ($attribute === 'released_at' && $this->{$attribute} === null) {
                $sqlString = str_replace(":$attribute", 'NULL', $sqlString);
            } else {
                $sqlString = str_replace(":$attribute", is_string($this->{$attribute}) ? '"' . $this->{$attribute} . '"' : $this->{$attribute}, $sqlString);
            }
        }

        if (!$this->query($sqlString)) {
            return false;
        }

        return true;
    }


    public function list($whereStatement): array
    {
        $tableName = $this->tableName();
        $attributes = $this->readAttributes();

        $sqlString = "SELECT " . implode(',', $attributes) . " FROM $tableName $whereStatement;";

        $dbResult = $this->query($sqlString);

        return $this->fetchList($dbResult);
    }

    public function getAll(): array
    {
        $tableName = $this->tableName();

        $sqlString = "SELECT * " . " FROM $tableName;";

        $dbResult = $this->query($sqlString);

        return $this->fetchList($dbResult);
    }

    public function one($whereStatement): array
    {
        $tableName = $this->tableName();
        $sqlString = "SELECT * " . " FROM $tableName " . "$whereStatement LIMIT 1;";


        $dbResult = $this->query($sqlString);

        return $this->fetchOne($dbResult);
    }

    public function update($where)
    {
        $tableName = $this->tableName();
        $attributes = $this->writeAttributes();

        $updateFields = "";
        $index = 0;

        foreach ($attributes as $attribute) {
            if ($index == 0) {
                $updateDelimiter = "";
            } else {
                $updateDelimiter = ", ";
            }

            $updateFields = $updateFields . $updateDelimiter . $attribute . "=:" . $attribute;
            $index++;
        }

        $sqlString = "UPDATE $tableName SET " . $updateFields . " WHERE $where;";

        foreach ($attributes as $attribute) {
            $sqlString = str_replace(":$attribute", is_numeric($this->{$attribute}) ? $this->{$attribute} : '"' . $this->{$attribute} . '"', $sqlString);
        }
        $this->query($sqlString);
    }

    public function validate()
    {
        $all_rules = $this->rules();


        foreach ($all_rules as $attribute => $rules) {
            $value = $this->{$attribute};

            foreach ($rules as $rule) {
                if ($rule == self::RULE_EMAIL) {
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $this->addValidationErrors($attribute, $rule);
                    }
                }

                if ($rule == self::RULE_REQUIRED && !$value) {
                    $this->addValidationErrors($attribute, $rule);
                }

                if ($rule == self::RULE_NUMBER && !is_numeric($value)) {
                    $this->addValidationErrors($attribute, $rule);
                }

                if ($rule == self::RULE_BOOL && !is_bool($value)) {
                    $this->addValidationErrors($attribute, $rule);
                }
            }
        }
    }

    private function errorMessages(): array
    {
        return [
            self::RULE_EMAIL => 'This field must be in valid email format.',
            self::RULE_REQUIRED => 'This field is required.',
            self::RULE_NUMBER => 'This field must be numeric',
            self::RULE_BOOL => 'This field must be boolean'
        ];
    }

    private function addValidationErrors($attribute, $rule): void
    {
        $message = $this->errorMessages()[$rule] ?? '';
        $this->errors[$attribute][] = $message;
    }
}