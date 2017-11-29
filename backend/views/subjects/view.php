<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Subjects */

$this->title = $model->subject_id;
?>
<div class="subjects-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->subject_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->subject_id], [
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
            'subject_name',
            'teacher',
            'start_date',
            'end_date',
        ],
    ]) ?>

</div>
