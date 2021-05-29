<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserDiagnosisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="user-diagnosis-index">

    <h1>Диагнозы</h1>

    <p>
        <?= Html::a('Добавить диагноз', ['user-diagnosis/create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => 'view',
    ]) ?>

    <?php Pjax::end(); ?>

</div>
