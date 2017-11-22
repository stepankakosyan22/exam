<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */
$this->title = "Edit";
?>
<div class="user-update">
    <?php if($model->id === Yii::$app->user->identity->id ){ ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <?php } else{?>
        <div class="alert alert-danger">Page not found!</div>
    <?php }?>
</div>
