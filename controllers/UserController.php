<?php

namespace app\controllers;

use app\core\Application;
use app\core\Constant;
use app\core\Controller;
use app\models\RoleModel;
use app\models\UserModel;
use app\models\UserRolesModel;


class UserController extends Controller
{
    public function create()
    {
        if (!Application::$app->session->get(Constant::$auth_session)) {
            header("location:" . "/login");
            exit();
        }

        return $this->view("employeeCreate", "main", null);
    }

    public function createPost()
    {
        if (!Application::$app->session->get(Constant::$auth_session)) {
            header("location:" . "/login");
            exit();
        }

        $model = new UserModel();
        $model->mapData($this->request->all());
        $model->password = password_hash($model->password, PASSWORD_DEFAULT);
        $model->validate();
        $model->create();

        $lastInsertedId = $model->getLastInsertedUser();


        if ($lastInsertedId) {
            $role_model = new RoleModel();
            $roleData = $role_model->one("WHERE id = 2");
            if ($roleData) {
                $role_model->mapData($roleData);

                $user_role_model = new UserRolesModel();
                $user_role_model->user_id = $lastInsertedId;
                $user_role_model->role_id = $role_model->id;
                $user_role_model->create();
            } else {
                Application::$app->session->setFlash(Constant::$flash_session_error, "Uloga nije pronađena.");
            }
        }

        if ($model->errors) {
            Application::$app->session->setFlash(Constant::$flash_session_error, "Neuspešno kreiran zaposleni!");
            return $this->view("employeeCreate", "main", $model);
        }
        Application::$app->session->setFlash(Constant::$flash_session_success, "Uspešno kreiran zaposleni!");
        header("location:" . "/employeeCreate");
    }

    public function index()
    {
        $model = new UserModel();
        $employees = $model->getAllEmployees();
        return $this->view('/employeeList', 'main', ['employees' => $employees]);
    }


    public function edit()
    {
        $userId = $this->request->one('id');
        $model = new UserModel();
        $model->id = $userId;
        $userData = $model->one("WHERE id = $userId");
        if ($userData) {
            $model->mapData($userData);
        }

        return $this->view("employeeEdit", "main", ['params' => $model]);
    }

    public function editPost()
    {
        $model = new UserModel();
        $model->mapData($this->request->all());

        $model->validate();

        if ($model->errors) {
            Application::$app->session->setFlash(Constant::$flash_session_error, "Neuspešna izmena zaposlenog");
            return $this->view("patientEdit", "main", ['params' => $model]);
        }

        $model->update("id = $model->id");

        Application::$app->session->setFlash(Constant::$flash_session_success, "Uspešna izmena zaposlenog");

        header("Location: /employeeList");
        exit;
    }

    public function authorizeRoles(): array
    {
        return [
            Constant::$administrator_role
        ];
    }
}