<?php

/* @var $this yii\web\View */

$this->title = 'Exam';
?>
<div class="site-index">
    <?php if (Yii::$app->user->identity->role ==='Moderator'){ ?>
        Moderator page
    <?php }?>
    <?php if (Yii::$app->user->identity->role ==='Student'){ ?>
        <div class="card">
            <?php foreach ($user as $us){?>
                <?php if ($us->prof_image){?>
                    <img src="<?= $us->prof_image ?>" alt="John" style="width:100%">
                <?php }else{?>
                    <img src="/images/user.png" alt="John" style="width:100%">
                <?php } ?>

                <h1><?= $us->full_name ?></h1>
                <p class="title">CEO & Founder, Example</p>
                <p>Harvard University</p>
                <div style="margin: 24px 0;">
                    <a class="card_a" href="/user/update/<?= $us->id ?>"><i class="glyphicon glyphicon-edit"></i></a>
                </div>
                <p><button class="card_button">Contact</button></p>
            <?php } ?>
        </div>
    <?php }?>
    <?php if (Yii::$app->user->identity->role ==='Main Admin'){ ?>
        Main Admin page
    <?php }?>
</div>
