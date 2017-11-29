<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Group';
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
            <tr>
                <td style="cursor:pointer" onclick="window.location='/groups/update/<?= $group->id_group?>';"><?= $group->group_name ?></td>
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

<div class="groups-index">
    <a class="add_class btn" href="/subjects/create">Add subject</a>
    <?php if ($subjects){?>
    <table class="table table-hover">
        <tr>
            <th>Subject name</th>
            <th>Teacher</th>
            <th>Subject started at</th>
            <th>Subject should end at</th>
        </tr>
        <?php foreach($subjects as $subject){?>
            <tr>
                <td style="cursor:pointer" onclick="window.location='/subjects/update/<?= $subject->subject_id?>';"><?= $subject->subject_name ?></td>
                <td>
                    <?php foreach($teachers as $teacher){
                        if ($teacher['id']==$subject->teacher){
                        ?>
                        <?= $teacher['name'].' '.$teacher['surname'] ?>
                    <?php }}?>
                </td>
                <td><?= $subject->start_date ?></td>
                <td>
                    <?= $subject->end_date ?>

                    <?= Html::a('', ['/subjects/delete', 'id' => $subject->subject_id], [
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
