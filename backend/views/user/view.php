<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->id;

?>
<div class="user-view">
    <p>
        <?= Html::a('<span style="font-size: 150%" class="glyphicon glyphicon-edit"></span>', ['editstudent', 'id' => $model->id]) ?>
        <?= Html::a('<span style="font-size: 150%; color:maroon" class="glyphicon glyphicon-remove"></span>', ['studentdelete', 'id' => $model->id], [
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('', ['/user/createstudent'], [
            'class' => 'btn btn-default glyphicon glyphicon-plus pull-right',
            'style' => 'font-size: 120%;color: darkgreen;cursor:pointer;margin:3px',
            'title' => 'Add another student'
        ]) ?>
    </p>
    <table class="table table-hover" style="width:50%;float:left">

        <tr>
            <td class="td_view">Name</td>
            <td><?= $model->name . ' ' . $model->surname ?></td>
        </tr>
        <tr>
            <td class="td_view">Username</td>
            <td><?= $model->username ?></td>
        </tr>
        <tr>
            <td class="td_view">Group</td>
            <?php foreach ($groups as $group) { ?>
                <?php if ($group['id_group'] == $model->group) { ?>
                    <td><?= $group['group_name'] ?></td>
                <?php }
            } ?>
        </tr>
        <tr>
            <td class="td_view">Enable</td>
            <td><?php if ($model->enable == 1) { ?>Enable<?php } else { ?> Disable<?php } ?></td>
        </tr>
        <tr>
            <td class="td_view">Activated</td>
            <td><?php if ($model->activated == 1) { ?>Activated<?php } else { ?> Non activated<?php } ?></td>
        </tr>

    </table>
    <div style="width:45%;float:right">
        <?php if ($model->passport_scan != '') { ?>
            <img style="width:100%" id="myImg" src="/<?= $model->passport_scan ?>" >
        <?php } else { ?>
            <span style="color:maroon">Edit student for adding passport scan.</span>
        <?php } ?>
    </div>


    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
    </div>
</div>
