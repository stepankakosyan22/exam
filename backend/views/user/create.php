<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'New user';
?>

<div class="user-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
