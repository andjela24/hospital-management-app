<?php

namespace app\controllers;

use app\core\Application;
use app\core\Constant;
use app\core\Controller;
use app\models\MedicineModel;
use app\models\PatientModel;

class MedicineController extends Controller
{
    public function create()
    {
        if (!Application::$app->session->get(Constant::$auth_session)) {
            header("location:" . "/login");
            exit();
        }

        return $this->view("medicineCreate", "main", null);
    }

    public function createPost()
    {
        if (!Application::$app->session->get(Constant::$auth_session)) {
            header("location:" . "/login");
            exit();
        }
        $model = new MedicineModel();
        $model->mapData($this->request->all());
        $model->validate();

        if ($model->errors) {
            Application::$app->session->setFlash(Constant::$flash_session_error, "Neuspešno kreiranje leka!");
            return $this->view("medicineCreate", "main", $model);
        }

        if (!$model->create()) {
            Application::$app->session->setFlash(Constant::$flash_session_error, "Greška pri unosu podataka u bazu!");
            header("location:" . "/medicineCreate");
            return;
        }

        Application::$app->session->setFlash(Constant::$flash_session_success, "Uspešno kreiran lek!");
        header("location:" . "/medicineCreate");
    }

    public function index()
    {
        $model = new MedicineModel();
        $medicines = $model->getAll();
        return $this->view('/medicineList', 'main', ['medicines' => $medicines]);
    }

    public function edit()
    {
        $id = $this->request->one('id');
        $model = new MedicineModel();
        $model->id = $id;
        $medicineData = $model->one("WHERE id = $id");

        if ($medicineData) {
            $model->mapData($medicineData);
        }

        return $this->view("medicineEdit", "main", ['params' => $model]);
    }

    public function editPost()
    {
        $model = new MedicineModel();
        $model->mapData($this->request->all());

        $model->validate();

        if ($model->errors) {
            Application::$app->session->setFlash(Constant::$flash_session_error, "Neuspešna izmena leka");
            return $this->view("medicineEdit", "main", ['params' => $model]);
        }

        $model->update("id = $model->id");

        Application::$app->session->setFlash(Constant::$flash_session_success, "Uspešna izmena leka");

        header("Location: /medicineList");
        exit;
    }

    public function authorizeRoles(): array
    {
        return [
            Constant::$administrator_role
        ];
    }
}