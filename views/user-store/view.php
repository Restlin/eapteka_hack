<?php

use app\models\Item;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserStore */
/* @var $dayModes array */
/* @var $foodModes array */

$this->title = $model->item->name;
$this->params['breadcrumbs'][] = ['label' => 'Моя аптечка', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-store-view">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?= $model->item->name ?></h1>
            </div>
            <div class="col-md-12 col-xs-12">
                <div class="imageWrapper">
                    <img src="images/noImage.jpg" alt="" />
                </div>
                <br />

                <div class="btn-group group-btn">
                    <?= Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-pencil']), ['update', 'id' => $model->id], ['class' => 'btn btn-circle btn-default btn-primary']) ?>
                    <?= Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-trash']), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-circle btn-default btn-danger btn-primary',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите удалить этот препарат?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <h3>Описание</h3>
                <p>
                    <?= $model->item->content ?>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <h3>Правила приема</h3>
                <ul>
                    <li>Принимать <?= $dayModes[$model->item->per_day] ?? "" ?></li>
                    <li>Принимать <?= $foodModes[$model->item->food_mode] ?? "" ?></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <h3>Условия хранения</h3>
                <div class="alert alert-danger alert-center" role="alert">
                    <h4><span class="glyphicon glyphicon-fire"></span> &nbsp;<b><?= $model->item->temp_max ?>℃</b> - Максимальная температура хранения</h4>
                </div>
                <div class="alert alert-info alert-center" role="alert">
                    <h4><span class="glyphicon glyphicon-asterisk"></span> &nbsp;<b><?= $model->item->temp_min ?>℃</b> - Минимальная температура хранения</h4>
                </div>
            </div>
        </div>
    </div>

</div>
