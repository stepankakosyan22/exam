<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin( ['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'role', [
        "template" => "<label> Role <span class='required_asterix'>*</span></label>\n{input}\n{hint}\n{error}"
    ])->dropDownList(['Moderator' => 'Moderator', 'Student' => 'Student'], ['prompt' => 'Select role']) ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <label class="btn btn-default btn-sm center-block btn-file">
        <i class="glyphicon glyphicon-upload" style="float:left" aria-hidden="true"></i>
        <?= $form->field($model, 'prof_image')->fileInput(['style'=>'display:none'])->label('Profile image') ?>
    </label>

    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn_create']) ?>

    <?php ActiveForm::end(); ?>

</div>
