<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Exams */

$this->title = 'Create Exams';
?>
<div class="exams-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
