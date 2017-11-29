<?php
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $form yii\bootstrap\ActiveForm */
/* @var $this yii\web\View */

$this->title = 'Exam';
?>
<?php if ( Yii::$app->user->identity->activated ===1){ ?>
<div class="site-index">
    <?php if (Yii::$app->user->identity->role ==='Admin'){ ?>
        Admin page
    <?php }?>
    <?php if (Yii::$app->user->identity->role ==='Student'){ ?>
        <div class="card">
            <?php foreach ($user as $us){?>
                <?php if ($us->passport_scan){?>
                    <img style="width: 100%" src="<?php echo Yii::$app->urlManagerBackend->baseUrl; ?>/<?= $us->passport_scan?>">
                <?php }else{?>
                    <img src="/images/user.png" alt="John" style="width:100%">
                <?php } ?>

                <h1><?= $us->name.' '.$us->surname ?></h1>
                <p class="title">CEO & Founder, Example</p>
                <p>Harvard University</p>
                <div style="margin: 24px 0;">
                    <a class="card_a" href="/user/update/<?= $us->id ?>"><i class="glyphicon glyphicon-edit"></i></a>
                </div>
                <p><button class="card_button">Contact</button></p>
            <?php } ?>
        </div>
    <?php }?>
    <?php  if (Yii::$app->user->identity->role ==='Teacher'){  ?>
        Teacher page
    <?php }?>
    <?php if (Yii::$app->user->identity->role ==='Main Admin'){ ?>
        Main Admin page
    <?php } ?>
</div>
<?php } else{
    if(!Yii::$app->user->isGuest){?>
        <div class="modal-dialog modal fade" data-show="true" id="myModal" >
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Write your new password</h4>
                </div>
                <div class="modal-body">
                    <form action="/" method="post">
                       <input type="text" class="form-control">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary change_password">Save password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php }
} ?>
