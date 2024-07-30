<?php
/** @var $params PrescriptionModel[] */
use app\models\PrescriptionModel;

?>

<div class="container">
    <h3>Svi recepti</h3>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Naziv leka</th>
            <th scope="col">Ime i prezime pacijenta</th>
            <th scope="col">Količina</th>
<!--            <th scope="col"></th>-->
        </tr>
        </thead>
        <tbody>
        <?php foreach ($params['prescriptions'] as $prescription): ?>
            <tr>
                <td><?php echo $prescription['medicine_name']; ?></td>
                <td><?php echo $prescription['patient_name']; ?></td>
                <td><?php echo $prescription['quantity']; ?></td>
<!--                <td>-->
<!--                    <a href="/prescriptionEdit?id=--><?php //echo $prescription['id']; ?><!--" class="btn btn-primary">Edit</a>-->
<!--                </td>-->
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
