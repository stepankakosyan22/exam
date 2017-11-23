<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->user->identity->name .  Yii::$app->user->identity->surname,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top navbar-nav nav',
            'data-tag'=>'yii2-menu',
            'style'=>'font-size:18px;color:white'

        ],
    ]);
    $menuItems[]= ['label' => '', 'url' => ['site/index'],'linkOptions' => ['data-method' => 'post','class'=>'glyphicon glyphicon-home']];
    if (Yii::$app->user->isGuest) {
        $menuItems[]= ['label' => ' Login', 'url' => ['site/login'],'linkOptions' => ['data-method' => 'post','class'=>'glyphicon glyphicon-log-in']];
    } else {
        $menuItems[]= ['label' => ' Admins', 'url' => ['/user/admins'],'linkOptions' => ['data-method' => 'post']];
        $menuItems[]= ['label' => ' Student', 'url' => ['user/students'],'linkOptions' => ['data-method' => 'post']];
        $menuItems[]= ['label' => ' Teacher', 'url' => ['user/teachers'],'linkOptions' => ['data-method' => 'post']];
        $menuItems[]= ['label' => ' Exams', 'url' => ['site/exams'],'linkOptions' => ['data-method' => 'post']];
        $menuItems[]= ['label' => ' Groups', 'url' => ['groups/index'],'linkOptions' => ['data-method' => 'post']];
        $menuItems[]= ['label' => ' +', 'url' => ['user/index'],'linkOptions' => ['data-method' => 'post']];
        $menuItems[]= ['label' => ' Logout', 'url' => ['site/logout'],'linkOptions' => ['data-method' => 'post','class'=>'glyphicon glyphicon-log-in']];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
