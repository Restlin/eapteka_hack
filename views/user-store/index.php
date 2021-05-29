<?php

use app\models\UserStore;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserStoreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $items array */
/* @var $users array */

$this->title = 'Моя аптечка';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-store-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить лекарство', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel, 'items' => $items, 'users' => $users]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function (UserStore $model, $key, $index, $widget) {
            return Html::a(Html::encode($model->item->name), ['view', 'id' => $model->id]);
        },
    ]); ?>

    <?php Pjax::end(); ?>

</div>
