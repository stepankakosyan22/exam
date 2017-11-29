<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Subjects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subjects-form">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
        'validationUrl' => Url::to('/subjects/subjectsvalidation')
    ]); ?>

    <?= $form->field($model, 'subject_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'teacher')->dropDownList(ArrayHelper::map(\backend\models\User::find()
        ->where(['role'=>'Teacher'])
        ->all(), 'id', "name"),['prompt'=>'Choose teacher']) ?>

    <?= $form->field($model, 'start_date')->textInput(['id'=>'from']) ?>

    <?= $form->field($model, 'end_date')->textInput(['id'=>'to']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn_create' : 'btn btn_create']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
