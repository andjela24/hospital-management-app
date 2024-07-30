<?php
/** @var $params MedicineModel
 */

use app\models\MedicineModel;

?>
    <div class="container">
        <h3>Svi lekovi</h3>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Naziv</th>
                <th scope="col">Proizvođač</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($params['medicines'] as $medicine): ?>
                <tr>
                    <td><?php echo $medicine['name']; ?></td>
                    <td><?php echo $medicine['manufacturer']; ?></td>
                    <td>
                        <a href="/medicineEdit?id=<?php echo $medicine['id']; ?>" class="btn btn-primary">Izmeni</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php
