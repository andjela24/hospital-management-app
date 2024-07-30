<?php
/** @var $params PatientModel
 */

use app\core\Application;
use app\models\PatientModel;


?>

<h3>Kreiranje pacijenta</h3>
<div class="card">
    <div class="card-body">
        <form action="/patientPost" method="post">
            <div class="mb-3">
                <?php Application::$app->form->renderInput($params, 'first_name', 'Ime', 'text', 'Unesi ime'); ?>
            </div>
            <div class="mb-3">
                <?php Application::$app->form->renderInput($params, 'last_name', 'Prezime', 'text', 'Unesi prezime'); ?>
            </div>
            <div class="mb-3">
                <?php Application::$app->form->renderInput($params, 'date_of_birth', 'Datum rođenja', 'text', 'DD/MM/GGGG'); ?>
            </div>
            <div class="mb-3">
                <?php Application::$app->form->renderInput($params, 'phone_number', 'Broj telefona', 'text', 'Unesi broj telefona'); ?>
            </div>
            <button type="submit" class="btn btn-primary">
                Kreiraj pacijenta
            </button>
        </form>
    </div>
</div>
