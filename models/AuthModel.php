<?php

namespace app\models;

use app\core\Application;
use app\core\Constant;
use app\core\Model;

class AuthModel extends Model
{
    public string $email;
    public string $password;

    public function writeAttributes(): array
    {
        return ["email", "password"];
    }

    public function readAttributes(): array
    {
        return ["email", "password", "id"];
    }

    public function rules(): array
    {
        return [
            'password' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL]
        ];
    }

    public function tableName(): string
    {
        return "users";
    }

    public function login(): bool
    {
        $result = $this->one("where email = '$this->email'");

        if ($result != null)
            return password_verify($this->password, $result["password"]);

        return false;
    }

    public function sessionData(): SessionModel
    {
        $sqlString = "SELECT u.email, r.name AS role
                FROM user_roles ur
                INNER JOIN users u ON ur.user_id = u.id
                INNER JOIN roles r ON ur.role_id = r.id
                WHERE u.email = '{$this->email}'";

        $dbResult = $this->query($sqlString);
        $sessionModel = new SessionModel($this->email);
        $rolesArray = [];

        while ($result = $dbResult->fetch_assoc()) {
            $rolesArray[] = $result['role'];
        }

        $sessionModel->setRoles($rolesArray);

        return $sessionModel;
    }
}