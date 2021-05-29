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
            $link = Html::a('Купить', ['user-store/create', 'substance_id' => $item->substance_id]);
            $substances[] = $item->substance->name.' '.$item->dose.'мг '.$link;
        }
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'author_id',
                'value' => $model->author->fio,
            ],
            [
                'attribute' => 'patient_id',
                'value' => $model->patient->fio,
            ],
            [
                'attribute' => 'diagnosis_id',
                'value' => $model->diagnosis->name,
            ],
            [
                'label' => 'Выписанные действующие вещества',
                'value' => implode('<br>', $substances),
                'format' => 'raw',
            ],
            'date',
        ],
    ]) ?>

</div>
