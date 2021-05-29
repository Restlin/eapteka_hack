<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserDiagnosis */

\yii\web\YiiAsset::register($this);
?>
<div class="user-diagnosis-view">

    <p class="addedItem">
        <span style="font-size: 18px"><?= $model->diagnosis->name ?> <?= $model->regular ? '(Хронический)' : ''?></span>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/user-diagnosis/delete', 'id' => $model->id], [
            'class' => '',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить диагноз?',
                'method' => 'post',
            ],
        ]) ?>
    </p>


</div>
