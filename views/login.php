<?php
/** @var $params AuthModel
 */

use app\core\Application;
use app\models\AuthModel;

?>

<form action="/loginPost" method="post">
    <div class="mb-3">
        <?php Application::$app->form->renderInput($params, 'email', 'Email', 'email', 'Unesi email'); ?>
    </div>
    <div class="mb-3">
        <?php Application::$app->form->renderInput($params, 'password', 'Šifra', 'password', 'Unesi šifru'); ?>
    </div>
    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">
        Uloguj se
    </button>
</form>