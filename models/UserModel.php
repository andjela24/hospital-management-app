<?php

namespace app\models;

use app\core\Model;

class UserModel extends Model
{
    public string $password;
    public string $name;
    public string $email;
    public string $phone_number;

    public function writeAttributes(): array
    {
        return ["password", "name", "phone_number", "email"];
    }

    public function readAttributes(): array
    {
        return ["id", "password", "name", "phone_number", "email"];
    }

    public function tableName(): string
    {
        return "users";
    }

    public function rules(): array
    {
        return [
            'password' => [self::RULE_REQUIRED],
            'phone_number' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'name' => [self::RULE_REQUIRED],
        ];
    }

    public function getAllEmployees(): array
    {
        $tableName = $this->tableName();

        $sqlString = "SELECT * " . " FROM $tableName " . "INNER JOIN user_roles ON users.id = user_roles.user_id 
            WHERE user_roles.role_id = 2;";

        $dbResult = $this->query($sqlString);

        return $this->fetchList($dbResult);
    }

    public function getLastInsertedUser(): int
    {
        $result = $this->connection()->query("SELECT id FROM users ORDER BY id DESC LIMIT 0, 1")->fetch_row();

        if ($result === false) {
            return 0;
        }

        return (int)$result[0];
    }
}