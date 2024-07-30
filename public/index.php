<?php

require_once __DIR__ . "/../vendor/autoload.php";

use app\controllers\AuthController;
use app\controllers\HomeController;
use app\controllers\PatientController;
use app\controllers\ReportController;
use app\controllers\UserController;
use app\controllers\MedicineController;
use app\controllers\PrescriptionController;
use app\core\Application;

$app = new Application();

$app->router->get("/", [HomeController::class, 'home']);
$app->router->get("/home", [HomeController::class, 'home']);
$app->router->get("/report", [ReportController::class, 'report']);

$app->router->get("/patientCreate", [PatientController::class, 'create']);
$app->router->post("/patientPost", [PatientController::class, 'createPost']);
$app->router->post('/patientEditPost', [PatientController::class, 'editPost']);
$app->router->get('/patientEdit', [PatientController::class, 'edit']);
$app->router->get('/patientList', [PatientController::class, 'index']);
$app->router->get('/patientDownload', [PatientController::class, 'downloadJson']);
$app->router->get('/patientDeactivate', [PatientController::class, 'deactivate']);

$app->router->get("/medicineCreate", [MedicineController::class, 'create']);
$app->router->post("/medicinePost", [MedicineController::class, 'createPost']);
$app->router->post('/medicineEditPost', [MedicineController::class, 'editPost']);
$app->router->get('/medicineEdit', [MedicineController::class, 'edit']);
$app->router->get("/medicineList", [MedicineController::class, 'index']);

$app->router->get("/prescriptionCreate", [PrescriptionController::class, 'create']);
$app->router->post("/prescriptionPost", [PrescriptionController::class, 'createPost']);
$app->router->post('/prescriptionEditPost', [PrescriptionController::class, 'editPost']);
$app->router->get('/prescriptionEdit', [PrescriptionController::class, 'edit']);
$app->router->get("/prescriptionList", [PrescriptionController::class, 'index']);

$app->router->get("/employeeCreate", [UserController::class, 'create']);
$app->router->post("/employeePost", [UserController::class, 'createPost']);
$app->router->post('/employeeEditPost', [UserController::class, 'editPost']);
$app->router->get('/employeeEdit', [UserController::class, 'edit']);
$app->router->get("/employeeList", [UserController::class, 'index']);

$app->router->get("/login", [AuthController::class, 'login']);
$app->router->post("/loginPost", [AuthController::class, 'loginPost']);
$app->router->get("/accessDenied", [AuthController::class, 'accessDenied']);
$app->router->get("/logout", [AuthController::class, 'logout']);

$app->router->get("/reportTotalPatientsPerPeriod", [ReportController::class, 'getTotalPatientsPerPeriod']);
$app->router->get("/reportActivePatients", [ReportController::class, 'getActivePatients']);
$app->router->get("/reportTotalPrescriptionPerPeriod", [ReportController::class, 'getTotalPrescriptionPerPeriod']);

$app->run();