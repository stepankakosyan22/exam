<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Questions';
?>
<div class="questions-index">

    <p>
        <?= Html::a('Create Questions', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'subject_id',
            'question_title',
            'answer_1',
            'answer_2',
            'answer_3',
            'answer_4',
            'true_answer',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
