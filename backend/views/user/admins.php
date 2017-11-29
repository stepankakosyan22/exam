<?php
use yii\helpers\Html;

$this->title = 'Admins';
$this->params['breadcrumbs'][] = $this->title;
?>
<a class="add_admin btn" href="/user/createadmin">Add Admin</a>
<?php if ($admins){ ?>
<table class="table table-hover">
    <?php foreach ($admins as $admin){ ?>
        <tbody>
            <tr>
                <td onclick="window.location='/user/editadmin/<?= $admin->id?>'" style="cursor:pointer"><?= $admin->name ?> <?= $admin->surname ?></td>
                <td>
                    <a href="/user/editadmin/<?= $admin->id ?>">
                        <span style="cursor:pointer; font-size: 120%;margin:3px;" class="glyphicon glyphicon-edit pull-right"></span>
                    </a>
                    <?= Html::a('', ['/user/teacherdelete', 'id' => $admin->id], [
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
    <?php } ?>
</table>
<?php }?>