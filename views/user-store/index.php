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
        <?= Html::a('Купить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel, 'items' => $items, 'users' => $users]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'col-sm-6 col-md-4'],
        'itemView' => function (UserStore $model, $key, $index, $widget) {
        $name = Html::a(Html::encode($model->item->name), ['view', 'id' => $model->id]);
        return <<<HTML
        <div class="thumbnail card">
              <img src="images/noImage.jpg" alt="..." />
              <div class="card-caption">
                <h3>{$name}</h3>
                <p class="cardContent cardContent-2">
                  {$model->item->content}
                </p>
                <p class="card-additional">
                  <a href="#" class="btn btn-primary" role="button">Действие №1</a>
                  <a href="#" class="btn btn-default" role="button">Действие №2</a>
                </p>
              </div>
        </div>
HTML;
        },
    ]); ?>

    <?php Pjax::end(); ?>

</div>
