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

    <?= $form->field($model, 'group_start')->widget(
        DatePicker::className(), ['inline' => false, 'clientOptions' => ['autoclose' => true, 'format' => 'yyyy-mm-dd',]
    ])->label('Start date <span style="color:red;font-size: 125%">*</span>') ?>

    <?= $form->field($model, 'group_end')->widget(
        DatePicker::className(), ['inline' => false, 'clientOptions' => ['autoclose' => true, 'format' => 'yyyy-mm-dd',]
    ])->label('End date <span style="color:red;font-size: 125%">*</span>') ?>

    <?php if ($model->id_group){ ?>
        <div data-id="<?= $model->id_group ?>" class="archive_class btn">Archive</div>
    <?php }?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn_create' : 'btn btn_create']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
