<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Group';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groups-index">
    <a class="add_class btn" href="/groups/create">Add group</a>
    <?php if ($groups){?>
    <table class="table table-hover">
        <tr>
            <th>Groups name</th>
            <th>Groups started at</th>
            <th>Groups should end at</th>
        </tr>
        <?php foreach($groups as $group){?>
            <tr <?php if ($group->archived===1){?>
                style="background-color: #cc5555   ;cursor: crosshair;" title="archived" <?php }else{?> style="cursor:pointer"
                <?php }?> onclick="window.location='/groups/update/<?= $group->id_group?>';">
                <td><?= $group->group_name ?></td>
                <td><?= $group->group_start ?></td>
                <td>
                    <?= $group->group_end ?>
                    <?= Html::a('', ['delete', 'id' => $group->id_group], [
                        'class' => 'glyphicon glyphicon-remove pull-right',
                        'style' => 'font-size: 120%;color: maroon;cursor:pointer;margin:3px',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                    <a href="/groups/update/<?= $group->id_group?>">
                        <span style="cursor:pointer; font-size: 120%;margin:3px;" class="glyphicon glyphicon-edit pull-right"></span>
                    </a>
                </td>
            </tr>
        <?php }?>
    </table>
<?php }?>
</div>
