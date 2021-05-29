<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserTimetable */
/* @var types array */

\yii\web\YiiAsset::register($this);
?>
<div class="user-timetable-view">

    <h1><?= Html::encode($model->date) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'user_id',
                'value' => $model->user->fio,
            ],
            'date',
            'content:ntext',
            [
                'attribute' => 'item_id',
                'value' => $model->item->name,
            ],
            [
                'attribute' => 'type',
                'value' => $types[$model->type]
            ],
            'complete:boolean',
        ],
    ]) ?>

</div>
