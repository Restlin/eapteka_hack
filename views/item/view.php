<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Item */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Препараты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-sm btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот препарат?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="imageWrapper">
        <?php
        $stream = $model->image ? stream_get_contents($model->image) : false;
        if ($stream) {
            $image = 'data:image/jpeg;charset=utf-8;base64,' . base64_encode($stream);
            echo Html::img($image, ['style' => '...']);
        } else {
            echo Html::img('images/noImage.jpg');
        }
        ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'group_id',
                'value' => $model->group->name,
            ],
            [
                'attribute' => 'substance_id',
                'value' => $model->substance->name,
            ],
            'dose',
            'food_mode',
            'per_day',
            'temp_min',
            'temp_max',
            'content:ntext',
            'price',
            'amount'
        ],
    ]) ?>

</div>
