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
                    <?php
                    $stream = $model->item->image ? stream_get_contents($model->item->image) : false;
                    if ($stream) {
                        $image = 'data:image/jpeg;charset=utf-8;base64,' . base64_encode($stream);
                        echo Html::img($image, ['style' => '...']);
                    } else {
                        echo Html::img('images/noImage.jpg');
                    }
                    ?>
                </div>
                <br />

                <div class="btn-group">
                    <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
                    <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-sm btn-danger btn-primary',
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
        <?php 
            $substance = $model->item->substance;
            $conflicts = [];
            foreach($model->item->substance->substanceEffects as $substanceEffect) {
                if(!$substanceEffect->positive) {
                    $conflicts[] = $substanceEffect->substanceId2->name;
                }
            } 
        ?>
        <div class="row">
            <div class="col-md-5">
                <h3>Действущее вещество</h3>
                <ul>
                    <li><?= $model->item->substance->name ?></li>
                    <li>Не сочетается с: <?= $conflicts ? implode(', ', $conflicts) : 'нет' ?></li>
                </ul>
            </div>
        </div>
    </div>

</div>
