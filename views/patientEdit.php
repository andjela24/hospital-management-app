<?php
/** @var $params PatientModel */

use app\core\Application;
use app\models\PatientModel;

?>
<h3>Izmeni pacijenta</h3>
<div class="card">
    <div class="card-body">
        <form action="/patientEditPost" method="post">
            <input type="hidden" name="id" value="<?php echo $params->id; ?>">
            <div class="mb-3">
                <?php Application::$app->form->renderInput($params, 'first_name', 'Ime', 'text', 'Unesi ime pacijenta'); ?>
            </div>
            <div class="mb-3">
                <?php Application::$app->form->renderInput($params, 'last_name', 'Prezime', 'text', 'Unesi prezime pacijenta'); ?>
            </div>
            <div class="mb-3">
                <?php Application::$app->form->renderInput($params, 'date_of_birth', 'Datum rođenja', 'text', 'DD/MM/YYYY'); ?>
            </div>
            <div class="mb-3">
                <?php Application::$app->form->renderInput($params, 'phone_number', 'Broj telefona', 'text', 'Unesi broj telefona pacijenta'); ?>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">
                    Sačuvaj promene
                </button>
            </div>
        </form>
    </div>
</div>

