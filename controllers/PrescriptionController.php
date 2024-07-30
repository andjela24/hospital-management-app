<?php

namespace app\controllers;

use app\core\Application;
use app\core\Constant;
use app\core\Controller;
use app\models\PrescriptionModel;
use Cassandra\Date;
use DateTime;

class PrescriptionController extends Controller
{
    public function create()
    {
        if (!Application::$app->session->get(Constant::$auth_session)) {
            header("location:" . "/login");
            exit();
        }

        return $this->view("prescriptionCreate", "main", null);
    }
    public function createPost()
    {
        if (!Application::$app->session->get(Constant::$auth_session)) {
            header("location:" . "/login");
            exit();
        }
        $model = new PrescriptionModel();
        $model->mapData($this->request->all());
        $model->created_at = new DateTime();
        $model->patient_id = $this->request->one('patient_id');

        $model->validate();

        if ($model->errors) {
            Application::$app->session->setFlash(Constant::$flash_session_error, "Neuspešno kreiranje recepta!");
            return $this->view("prescriptionCreate", "main", $model);
        }

        if (!$model->create()) {
            Application::$app->session->setFlash(Constant::$flash_session_error, "Greška pri unosu podataka u bazu!");
            header("location:" . "/patientList");
            return;
        }

        Application::$app->session->setFlash(Constant::$flash_session_success, "Uspešno kreiran recept!");
        header("location:" . "/prescriptionList");
    }

    public function index()
    {
        $model = new PrescriptionModel();
        $prescriptions = $model->getAllPrescription();
        return $this->view('/prescriptionList', 'main', ['prescriptions' => $prescriptions]);
    }

    public function edit()
    {
        $id = $this->request->one('id');
        $model = new PrescriptionModel();
        $model->id = $id;
        $prescriptionData = $model->one("WHERE id = $id");
        if ($prescriptionData) {
            $model->mapData($prescriptionData);
        }

        return $this->view("prescriptionEdit", "main", ['params' => $model]);
    }

    public function editPost()
    {
        $model = new PrescriptionModel();
        $model->mapData($this->request->all());

        $model->validate();

        if ($model->errors) {
            Application::$app->session->setFlash(Constant::$flash_session_error, "Neuspešna izmena recepta");
            return $this->view("medicineEdit", "main", ['params' => $model]);
        }

        $model->update("id = $model->id");

        Application::$app->session->setFlash(Constant::$flash_session_success, "Uspešna izmena recepta");

        header("Location: /prescriptionList");
        exit;
    }

    public function authorizeRoles(): array
    {
        return [
            Constant::$zaposleni_role,
            Constant::$administrator_role
        ];
    }
}