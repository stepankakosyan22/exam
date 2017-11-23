<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if ($this->title=="New user"){ ?>
        <?= $form->field($model, 'role')
            ->dropDownList(['Admin' => 'Admin', 'Student' => 'Student', 'Teacher' => 'Teacher'], ['prompt' => 'Select role']) ?>
    <?php } elseif ($this->title=="Admin"){
        $model->role="Admin"; ?>
    <div style="display:none">
        <?=$form->field($model, 'role')->textInput();?>
    </div>
    <?php } elseif ($this->title=="Student"){
        $model->role="Student"; ?>
    <div style="display:none">
        <?= $form->field($model, 'role')->textInput();?>
    </div>
    <?php } elseif ($this->title=="Teacher") {
        $model->role="Teacher";?>
    <div style="display:none">
        <?= $form->field($model, 'role')->textInput();?>
    </div>
    <?php }?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?php if ($this->title=="Student"){ ?>
        <?= $form->field($model, 'passport_scan')->fileInput()  ?>

        <?= $form->field($model, 'group')->textInput()  ?>
    <?php } ?>

    <?php if ($model->id && ($this->title=="Teacher" ||$this->title=="Student")){ ?>
        <?= $form->field($model, 'enable')->checkbox()  ?>
    <?php }?>
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn_create']) ?>

    <?php ActiveForm::end(); ?>

</div>
