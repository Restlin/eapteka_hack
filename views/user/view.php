<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $familyIndex string */
/* @var $diagnosisIndex string */

$this->title = $model->fio;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <div class="col-md-12">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="col-md-12 col-xs-12">
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
        <br />
        <p>
            <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
        </p>
    </div>

<div class="col-md-12 col-xs-12">
    <?= $familyIndex ?>
</div>
<div class="col-md-12 col-xs-12">
    <?= $diagnosisIndex ?>
</div>
</div>
