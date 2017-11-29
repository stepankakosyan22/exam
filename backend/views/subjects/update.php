<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Subjects */

$this->title = 'Update Subjects: ' . $model->subject_id;
?>
<div class="subjects-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
