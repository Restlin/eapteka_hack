<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Prescription */

\yii\web\YiiAsset::register($this);
?>
<div class="prescription-view">

    <?php
    $substances = [];
    foreach($model->items as $item) {
        $name = Html::tag('b', "{$item->substance->name} {$item->dose}мг.");
        $cart = Html::tag('button', Html::tag('span', '', ['class' => 'glyphicon glyphicon-shopping-cart']), ['class' => 'btn btn-icon']);
        $link = Html::a(Html::tag('span', $name . $cart, ['class' => 'chip']), ['user-store/create', 'substance_id' => $item->substance_id]);
        $substances[] = $link;
    }
    ?>
    <div class="row">
        <div class="col-sm-12 col-md-12">
    <div class="thumbnail card">
        <div class="card-caption">
            <p><b>Врач: </b><span><?= $model->author->fio ?></span></p>
            <p><b>Пациент: </b><span><?= $model->patient->fio ?></span></p>
            <p><b>Диагноз: </b><span><?= $model->diagnosis->name ?></span></p>
            <p><b>Дата рецепта: </b><span><?= $model->date ?></span></p>
            <p><b>Лекарства:</b></p>
            <div class="chipBox">
                <?= implode('<br>', $substances) ?>
            </div>
        </div>
    </div>
        </div>
    </div>
</div>
