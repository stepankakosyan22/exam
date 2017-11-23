<?php
use yii\helpers\Html;

$this->title = 'Student';
$this->params['breadcrumbs'][] = $this->title;
?>
<a class="add_admin btn" href="/user/createstudent">Add Student</a>

<input class="form-control" id="studentSearchInput" type="text" placeholder="Search.." style="width:25%;float:right">

<div class="row">
    <table class="table table-hover">
        <tr>
            <th>Full name</th>
            <th>Group</th>
        </tr>
        <?php foreach ($students as $student){ ?>
            <tbody id="StudentTableItem">
                <tr>
                    <td><?= $student->name ?> <?= $student->surname ?></td>
                    <td>Group
                        <a href="/user/editadmin/<?= $student->id ?>">
                           <span style="cursor:pointer; font-size: 120%;margin:3px;" class="glyphicon glyphicon-edit pull-right"></span>
                        </a>
                         <?= Html::a('', ['/user/studentdelete', 'id' => $student->id], [
                            'class' => 'glyphicon glyphicon-remove pull-right',
                            'style' => 'font-size: 120%;color: maroon;cursor:pointer;margin:3px',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </td>
                </tr>
            </tbody>
        <?php }?>
    </table>
</div>