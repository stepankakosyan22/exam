<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;
use frontend\models\Groups;
/* @var $this yii\web\View */
/* @var $model frontend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['options' => [
        'id' => 'userform',
        'enctype' => 'multipart/form-data'
    ]]); ?>
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

        <?= $form->field($model, 'name')->textInput(['maxlength' => true,'class'=>'name_main form-control']) ?>

        <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <div class="student_part">
        <?php if ($this->title=="Student" || $this->title=="Edit student" ){ ?>
            <?= $form->field($model, 'passport_scan')->fileInput()  ?>
            <?= $form->field($model, 'group')->dropDownList(ArrayHelper::map(Groups::find()
                ->all(), 'id_group', "group_name"),['prompt'=>'Select group'])->label('Choose group <span style="color:red;font-size: 125%">*</span>') ?>
        <?php } ?>
    </div>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?php if ($model->id && ($this->title=="Edit teacher" || $this->title=="Edit student")){ ?>
        <?= $form->field($model, 'enable')->checkbox()  ?>
    <?php }?>

    <?php if($this->title!="Student"){ ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn_create']) ?>
    <?php } ?>

    <?php if($this->title=="Student" && !$model->id){?>
        <?= Html::submitButton( 'Save', ['class' => 'btn btn_save']) ?>
        <button type="button" class='btn btn_finish'>Finish </button>
    <?php }?>

    <?php if ($model->id){ ?>
        <?php if ($model->role=="Admin"){ ?>
            <?= Html::a('', ['/user/admindelete', 'id' => $model->id], [
                'class' => 'btn btn-danger glyphicon glyphicon-remove pull-right',
                'style' => 'font-size: 120%;color: maroon;cursor:pointer;margin:3px',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php }elseif($model->role=="Student"){?>
            <?= Html::a('', ['/user/studentdelete', 'id' => $model->id], [
                'class' => 'btn btn-danger glyphicon glyphicon-remove pull-right',
                'style' => 'font-size: 120%;color: maroon;cursor:pointer;margin:3px',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php }elseif ($model->role=="Teacher"){?>
            <?= Html::a('', ['/user/teacherdelete', 'id' => $model->id], [
                'class' => 'btn btn-danger glyphicon glyphicon-remove pull-right',
                'style' => 'font-size: 120%;color: maroon;cursor:pointer;margin:3px',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php }?>
    <?php }?>
    <?php ActiveForm::end(); ?>
    <div id="dialog-confirm"></div>
</div>
