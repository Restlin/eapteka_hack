<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserFamily */
/* @var $roles array */

\yii\web\YiiAsset::register($this);
?>
<div class="user-family-view">

    <p>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этого родственника?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'role',
                'value' => $roles[$model->role]
            ],
            [
                'attribute' => 'user_id2',
                'value' => $model->user2->fio
            ],
        ],
    ]) ?>

</div>
