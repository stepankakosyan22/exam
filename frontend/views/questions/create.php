<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Questions */

$this->title = 'Create Questions';
?>
<div class="questions-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
