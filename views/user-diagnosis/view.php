<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserDiagnosis */

\yii\web\YiiAsset::register($this);
?>
<div class="user-diagnosis-view">

    <p>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить диагноз?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'diagnosis_id',
                'value' => $model->diagnosis->name,
            ],
            'regular:boolean',
        ],
    ]) ?>

</div>
