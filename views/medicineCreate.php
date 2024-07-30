<?php
/** @var $params MedicineModel
 */

use app\core\Application;
use app\models\MedicineModel;

?>

<h3>Kreiraj lek</h3>
<div class="card">
    <div class="card-body">
        <form action="/medicinePost" method="post">
            <div class="mb-3">
                <?php Application::$app->form->renderInput($params, 'name', 'Naziv', 'text', 'Unesi naziv leka'); ?>
            </div>
            <div class="mb-3">
                <?php Application::$app->form->renderInput($params, 'manufacturer', 'Proizvođač', 'text', 'Unesi naziv proizvođača'); ?>
            </div>
            <div class="mb-3">
                <?php Application::$app->form->renderInput($params, 'image_path', 'URL slike', 'text', 'Unesi URL slike'); ?>
            </div>
            <button type="submit" class="btn btn-primary">
                Kreiraj lek
            </button>
        </form>
    </div>
</div>
