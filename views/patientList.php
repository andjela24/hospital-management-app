<?php
/** @var $params PatientModel
 */

use app\models\PatientModel;

?>
<div class="container">
    <h3>Svi pacijenti</h3>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Ime</th>
            <th scope="col">Prezime</th>
            <th scope="col">Datum rođenja</th>
            <th scope="col">Broj telefona</th>
            <th scope="col">Aktivan</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($params['patients'] as $patient): ?>
            <tr>
                <td><?php echo $patient['first_name']; ?></td>
                <td><?php echo $patient['last_name']; ?></td>
                <td><?php echo $patient['date_of_birth']; ?></td>
                <td><?php echo $patient['phone_number']; ?></td>
                <td><?php echo $patient['active']; ?></td>
                <td>
                    <a href="/patientEdit?id=<?php echo $patient['id']; ?>" class="btn btn-primary">Izmeni</a>
                </td>
                <td>
                    <a href="/prescriptionCreate?id=<?php echo $patient['id']; ?>" class="btn btn-primary">Dodaj recept</a>
                </td>
                <td>
                    <a href="/patientDeactivate?id=<?php echo $patient['id']; ?>" class="btn btn-danger">
                        <i class="ti ti-x" style="color: red;"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
