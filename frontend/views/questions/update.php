<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Questions */

$this->title = 'Update Questions: ' . $model->question_id;
?>
<div class="questions-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
