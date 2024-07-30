<?php

namespace app\controllers;

use app\core\Application;
use app\core\Constant;
use app\core\Controller;
use app\models\PatientModel;
use DateTime;

class PatientController extends Controller
{
    public function create()
    {
        if (!Application::$app->session->get(Constant::$auth_session)) {
            header("location:" . "/login");
            exit();
        }

        return $this->view("patientCreate", "main", null);
    }

    public function createPost()
    {
        if (!Application::$app->session->get(Constant::$auth_session)) {
            header("location:" . "/login");
            exit();
        }
        $model = new PatientModel();

        $model->mapData($this->request->all());
        $model->active = true;
        $model->created_at = new DateTime();
        $model->released_at = null;
        $model->validate();

        if ($model->errors) {
            Application::$app->session->setFlash(Constant::$flash_session_error, "Neuspešno kreiranje pacijenta!");
            return $this->view("patientCreate", "main", $model);
        }

        if (!$model->create()) {
            Application::$app->session->setFlash(Constant::$flash_session_error, "Greška pri unosu podataka u bazu!");
            header("location:" . "/patientCreate");
            return;
        }

        Application::$app->session->setFlash(Constant::$flash_session_success, "Uspešno kreiran pacijent!");
        header("location:" . "/patientCreate");
    }

    public function index()
    {
        $model = new PatientModel();
        $patients = $model->getAll();

        return $this->view('/patientList', 'main', ['patients' => $patients]);
    }

    public function edit()
    {
        $patientId = $this->request->one('id');
        $model = new PatientModel();
        $model->id = $patientId;

        $patientData = $model->one("WHERE id = $patientId");

        if ($patientData) {
            $model->mapData($patientData);
        }
        return $this->view("patientEdit", "main", ['params' => $model]);
    }

    public function editPost()
    {
        $model = new PatientModel();
        $model->mapData($this->request->all());

        $model->validate();

        if ($model->errors) {
            Application::$app->session->setFlash(Constant::$flash_session_error, "Neuspešna izmena pacijenta");
            return $this->view("patientEdit", "main", ['params' => $model]);
        }

        $model->update("id = $model->id");

        Application::$app->session->setFlash(Constant::$flash_session_success, "Uspešna izmena pacijenta");

        header("Location: /patientList");
        exit;
    }

    public function downloadJson()
    {
        $model = new PatientModel();
        $patients = $model->getAll();
        var_dump($patients);

        $fileName = 'pacijenti_' . date('Y-m-d_H-i-s') . '.json';
        $downloadFolder = __DIR__ . '/../downloads/';
        $filePath = $downloadFolder . $fileName;
        file_put_contents($filePath, json_encode($patients));

        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');

        exit;
    }

    public function deactivate()
    {
        $model = new PatientModel();
        $model->mapData($this->request->all());

        if ($model->active == 0) {
            Application::$app->session->setFlash(Constant::$flash_session_error, "Pacijent je već otpušten");
        }

        $model->deactivate();

        Application::$app->session->setFlash(Constant::$flash_session_success, "Uspešno otpušten pacijent");

        header("Location: /patientList");
        exit;
    }

    public function authorizeRoles(): array
    {
        return [
            Constant::$administrator_role,
            Constant::$zaposleni_role
        ];
    }
}