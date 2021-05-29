<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserFamily */
/* @var $roles array */

\yii\web\YiiAsset::register($this);
?>
<div class="user-family-view">

    <p class="addedItem">
        <span style="font-size: 18px"><?= $model->user2->fio ?> (<?= $roles[$model->role] ?>)</span>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/user-family/delete', 'id' => $model->id], [
            'class' => '',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этого родственника?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
