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
        'itemOptions' => ['class' => 'col-sm-6 col-md-4'],
        'itemView' => function (UserStore $model, $key, $index, $widget) {
        $name = Html::a(Html::encode($model->item->name), ['view', 'id' => $model->id]);
        $dayMode = "";
        $foodMode = "";
        return <<<HTML
        <div class="thumbnail card">
              <img src="images/noImage.jpg" alt="..." />
              <div class="card-caption">
                <h3 class="cardContent cardContent-2">{$name}</h3>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Осталось: {$model->item->amount}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h3>Условия хранения</h3>
                        <div class="alert alert-danger alert-center" role="alert">
                            <h4><span class="glyphicon glyphicon-fire"></span> &nbsp;<b>{$model->item->temp_max}℃</b> - Максимальная температура хранения</h4>
                        </div>
                        <div class="alert alert-info alert-center" role="alert">
                            <h4><span class="glyphicon glyphicon-asterisk"></span> &nbsp;<b>{$model->item->temp_min}℃</b> - Минимальная температура хранения</h4>
                        </div>
                    </div>
                </div>

              </div>
        </div>
HTML;
        },
    ]); ?>

    <?php Pjax::end(); ?>

</div>
