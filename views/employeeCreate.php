<?php
/** @var $params UserModel
 */

use app\core\Application;
use app\models\UserModel;

?>

<h3>Kreiraj zaposlenog</h3>
<div class="card">
    <div class="card-body">
        <form action="/employeePost" method="post">
            <div class="mb-3">
                <?php Application::$app->form->renderInput($params, 'name', 'Ime', 'text', 'Unesi ime zaposlenog'); ?>
            </div>
            <div class="mb-3">
                <?php Application::$app->form->renderInput($params, 'phone_number', 'Broj telefona', 'text', 'Unesi broj telefona'); ?>
            </div>
            <div class="mb-3">
                <?php Application::$app->form->renderInput($params, 'email', 'Email', 'email', 'Unesi email '); ?>
            </div>
            <div class="mb-3">
                <?php Application::$app->form->renderInput($params, 'password', 'Šifra', 'password', 'Unesi šifru'); ?>
            </div>
            <button type="submit" class="btn btn-primary">
                Kreiraj zaposlenog
            </button>
        </form>
    </div>
</div>