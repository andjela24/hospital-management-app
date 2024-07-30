<?php
/** @var $params UserModel
 */

use app\models\UserModel;

?>
    <div class="container">
        <h3>Svi zaposleni</h3>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Ime</th>
                <th scope="col">Email</th>
                <th scope="col">Broj telefona</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($params['employees'] as $employee): ?>
                <tr>
                    <td><?php echo $employee['name']; ?></td>
                    <td><?php echo $employee['email']; ?></td>
                    <td><?php echo $employee['phone_number']; ?></td>
                    <td>
                        <a href="/employeeEdit?id=<?php echo $employee['user_id']; ?>" class="btn btn-primary">Izmeni</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php
