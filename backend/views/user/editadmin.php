<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'Edit admin';
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
