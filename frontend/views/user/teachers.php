<?php
use yii\helpers\Html;

$this->title = 'Teachers';
$this->params['breadcrumbs'][] = $this->title;
?>
<a class="add_admin btn" href="/user/createteacher">Add Teacher</a>
<?php if ($teachers){ ?>
    <table class="table table-hover">
        <tr>
            <th>Teacher name</th>
            <th></th>
        </tr>
        <?php foreach ($teachers as $teacher){ ?>
            <tbody onclick="window.location='/user/editteacher/<?= $teacher->id?>'" style="cursor:pointer">
            <tr>
                <td><?= $teacher->name ?> <?= $teacher->surname ?></td>
                <td>
                    <a href="/user/editteacher/<?= $teacher->id ?>">
                        <span style="cursor:pointer; font-size: 120%;margin:3px;" class="glyphicon glyphicon-edit pull-right"></span>
                    </a>
                    <?= Html::a('', ['/user/teacherdelete', 'id' => $teacher->id], [
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
<?php }?>