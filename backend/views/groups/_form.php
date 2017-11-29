<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Groups */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="groups-form">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
        'validationUrl' => Url::to('/groups/groupsvalidation')
    ]) ?>

    <?= $form->field($model, 'group_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_start')->textInput(['id'=>'from'])?>

    <?= $form->field($model, 'group_end')->textInput(['id'=>'to']) ?>


    <?php if ($model->id_group){ ?>
        <div data-id="<?= $model->id_group ?>" class="archive_class btn">Archive</div>
        <?= Html::a('', ['/groups/delete', 'id' => $model->id_group], [
            'class' => 'btn btn-default glyphicon glyphicon-remove pull-right',
            'style' => 'font-size: 120%;color: maroon;cursor:pointer;margin:3px',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn_create' : 'btn btn_create']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
