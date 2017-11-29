<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Groups */

$this->title = 'Add new group';
?>
<div class="groups-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
