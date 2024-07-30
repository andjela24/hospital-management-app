<?php
/** @var $params UserModel */

use app\core\Application;
use app\models\UserModel;
?>

    <h3>Izmeni zaposlenog</h3>
    <div class="card">
        <div class="card-body">
            <form action="/employeeEditPost" method="post">
                <input type="hidden" name="id" value="<?php echo $params->id; ?>">
                <div class="mb-3">
                    <?php Application::$app->form->renderInput($params, 'name', 'Ime', 'text', 'Unesi ime zaposlenog'); ?>
                </div>
                <div class="mb-3">
                    <?php Application::$app->form->renderInput($params, 'email', 'Email', 'text', 'Unesi emial'); ?>
                </div>
                <div class="mb-3">
                    <?php Application::$app->form->renderInput($params, 'password', 'Šifra', 'text', 'Unesi šifru'); ?>
                </div>
                <div class="mb-3">
                    <?php Application::$app->form->renderInput($params, 'phone_number', 'Broj telefona', 'text', 'Unesi broj telefona'); ?>
                </div>
                <button type="submit" class="btn btn-primary">
                    Sačuvaj promene
                </button>
            </form>
        </div>
    </div>
<?php
