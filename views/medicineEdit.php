<?php
/** @var $params MedicineModel */

use app\core\Application;
use app\models\MedicineModel;
?>

    <h3>Izmeni lek</h3>
    <div class="card">
        <div class="card-body">
            <form action="/medicineEditPost" method="post">
                <input type="hidden" name="id" value="<?php echo $params->id; ?>">
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
                    Sačuvaj promene
                </button>
            </form>
        </div>
    </div>
<?php
