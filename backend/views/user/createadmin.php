<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'Admin';
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>

