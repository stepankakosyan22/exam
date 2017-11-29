<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Exams */

$this->title = 'Update Exams: ' . $model->exam_id;
?>
<div class="exams-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
