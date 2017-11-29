<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Groups */

$this->title = 'Edit ' . $model->group_name .' group';
?>
<div class="groups-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
