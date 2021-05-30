<?php

use yii\helpers\Html;

/* @var $model \app\models\UserStore */
$name = Html::a(Html::encode($model->item->name), ['view', 'id' => $model->id]);
$stream = $model->item->image ? stream_get_contents($model->item->image) : false;
if ($stream) {
    $image = 'data:image/jpeg;charset=utf-8;base64,' . base64_encode($stream);
    $img = Html::img($image, ['style' => '...']);
} else {

    $img = Html::img('images/noImage.jpg');
}
?>


<div class="thumbnail card">
    <div class="imageWrapper">
        <?= $img ?>
    </div>
    <div class="card-caption">
        <h3 class="cardContent cardContent-2"><?= $name ?></h3>
        <div class="row">
            <div class="col-md-12">
                <h4>Осталось: <?= $model->amount ?></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4>Принимает: <?= $model->target->fio ?></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
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
