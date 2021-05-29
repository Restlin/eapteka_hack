<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Item;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Препараты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'name',
                'value' => function(Item $model) {
                    return Html::a($model->name, ['item/view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'group_id',
                'value' => function(Item $model) {
                    return $model->group->name;
                }
            ],
            [
                'attribute' => 'substance_id',
                'value' => function(Item $model) {
                    return $model->substance->name;
                }
            ],
            'dose',
            'amount',
            //'food_mode',
            //'per_day',
            'temp_min',
            'temp_max',
            //'content:ntext',
            'price'
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
