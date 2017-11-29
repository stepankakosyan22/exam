<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\db\Query;
use frontend\models\Questions;
use frontend\models\ExamQuestions;
use frontend\models\Exams;

/* @var $this yii\web\View */
/* @var $model frontend\models\Exams */
/* @var $form yii\widgets\ActiveForm */


$current_teacher_id = \Yii::$app->user->id;
$questions = Questions::find()->all();
?>

<div class="exams-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subject_id')->dropDownList(
        ArrayHelper::map((new Query())
            ->select('*')
            ->from('subjects')
            ->where(['teacher' => $current_teacher_id])
            ->all(), 'subject_id', 'subject_name'),
        ['prompt' => 'Select Subject']
    )->label('Choose subject <span class="required_asterix">*</span>') ?>

    <?= $form->field($model, 'group_id')->dropDownList(
        ArrayHelper::map((new Query())
            ->select('*')
            ->from('groups')
            ->all(), 'id_group', 'group_name'),
        ['prompt' => 'Select Group']
    )->label('Choose group <span class="required_asterix">*</span>') ?>

    <?= $form->field($model, 'start')->textInput(['id' => 'datepicker']) ?>

    <?= $form->field($model, 'duration')->textInput() ?>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>Question title</th>
            <th>Select question</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($questions as $question) { ?>

            <tr>
                <td><?= $question['question_title'] ?></td>
                <td><?= $form->field($question, 'question_id')->checkbox() ?></td>
            </tr>

        <?php } ?>
        </tbody>

    </table>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
