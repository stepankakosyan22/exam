<?php
use yii\helpers\Html;

$this->title = 'Admins';
$this->params['breadcrumbs'][] = $this->title;
?>
<a class="add_admin btn" href="/user/createadmin">Add Admin</a>

<div class="row">
    <?php foreach ($admins as $admin){ ?>
        <div class="col-sm-3" style="display:flex">
            <div style="border:1px solid black;margin:10px;padding: 10px; border-radius: 4px" class="card">
                <div class="card-block">
                    <h3 class="card-title"><?= $admin->name ?> <?= $admin->surname ?></h3>
                    <p class="card-text"><?= $admin->username ?></p>
                    <a href="/user/editadmin/<?= $admin->id ?>">
                        <span style="cursor:pointer; font-size: 120%;margin:3px;" class="glyphicon glyphicon-edit pull-right"></span>
                    </a>
                    <?= Html::a('', ['/user/delete', 'id' => $admin->id], [
                        'class' => 'glyphicon glyphicon-remove pull-right',
                        'style' => 'font-size: 120%;color: maroon;cursor:pointer;margin:3px',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    <?php }?>
</div>