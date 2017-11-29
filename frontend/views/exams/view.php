<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Exams */

$this->title = $model->exam_id;
?>
<div class="exams-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->exam_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->exam_id], [
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
            'exam_id',
            'group_id',
            'subject_id',
            'start',
            'duration',
            'active',
        ],
    ]) ?>

</div>
