<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Subjects */

$this->title = 'Create Subjects';

?>
<div class="subjects-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
