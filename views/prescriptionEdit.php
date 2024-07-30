<?php
/** @var $params PrescriptionModel */

use app\models\MedicineModel;
use app\models\PatientModel;
use app\models\PrescriptionModel;

$medicineModel = new MedicineModel();
$medicines = $medicineModel->getAll();

$patientModel = new PatientModel();
$patients = $patientModel->getAll();
?>
    <h3>Izmeni recept</h3>
    <div class="card">
        <div class="card-body">
            <form action="/prescriptionEditPost" method="post">
                <input type="hidden" name="id" value="<?php echo $params->id; ?>">
                <div class="mb-3">
                    <label for="medicine">Naziv leka</label>
                    <select name="medicine" id="medicine" class="form-select">
                        <?php foreach ($medicines as $medicine): ?>
                            <option value="<?php echo $medicine['id']; ?>" <?php echo ($medicine['id'] == $params->medicine_id) ? 'selected' : ''; ?>><?php echo $medicine['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="patient">Ime pacijenta</label>
                    <select name="patient" id="patient" class="form-select">
                        <?php foreach ($patients as $patient): ?>
                            <option value="<?php echo $patient['id']; ?>" <?php echo ($patient['id'] == $params->patient_id) ? 'selected' : ''; ?>><?php echo $patient['first_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="quantity">Količina</label>
                    <input type="text" name="quantity" id="quantity" class="form-control" value="<?php echo $params->quantity; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Sačuvaj lek</button>
            </form>
        </div>
    </div>