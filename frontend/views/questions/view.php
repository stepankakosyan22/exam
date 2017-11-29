<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Questions */

$this->title = $model->question_title;
?>
<div class="questions-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->question_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->question_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'subject_id',
            'question_title',
            'answer_1',
            'answer_2',
            'answer_3',
            'answer_4',
            'true_answer',
        ],
    ]) ?>

</div>
