<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\db\Query;
/* @var $this yii\web\View */
/* @var $model frontend\models\Questions */
/* @var $form yii\widgets\ActiveForm */
$current_teacher_id = \Yii::$app->user->id;
?>

<div class="questions-form">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
        'validationUrl' => \yii\helpers\Url::to('/questions/questionsvalidation')
    ]); ?>

    <?= $form->field($model, 'subject_id')->dropDownList(
        ArrayHelper::map((new Query())
            ->select('*')
            ->from('subjects')
            ->where(['teacher' => $current_teacher_id])
            ->all(), 'subject_id', 'subject_name'),
        ['prompt' => 'Select Subject']
    )->label('Choose subject <span class="required_asterix">*</span>') ?>

    <?= $form->field($model, 'question_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer_3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer_4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'true_answer')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
