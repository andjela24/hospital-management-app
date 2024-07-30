<?php
use app\core\Application;
use app\models\MedicineModel;

$medicineModel = new MedicineModel();
$medicines = $medicineModel->getAll();
?>

<h3>Kreiraj recept</h3>
<div class="card">
    <div class="card-body">
        <form action="/prescriptionPost" method="post">
            <input type="hidden" name="patient_id" value="<?php echo $_GET['id']; ?>">

            <div class="mb-3">
                <label for="medicine_id" class="form-label">Lek</label>
                <select class="form-select" name="medicine_id" id="medicine_id">
                    <option value="">Naziv leka</option>
                    <?php foreach ($medicines as $medicine): ?>
                        <option value="<?php echo $medicine['id']; ?>"><?php echo $medicine['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Količina</label>
                <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Unesi količinu">
            </div>
            <button type="submit" class="btn btn-primary">Kreiraj recept</button>
        </form>
    </div>
</div>




