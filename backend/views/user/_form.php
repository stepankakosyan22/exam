<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'role', [
        "template" => "<label> Role <span class='required_asterix'>*</span></label>\n{input}\n{hint}\n{error}"
    ])->dropDownList(['Moderator' => 'Moderator', 'Student' => 'Student', 'Teacher' => 'Teacher'], ['prompt' => 'Select role']) ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

     <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn_create']) ?>

    <?php ActiveForm::end(); ?>

</div>
