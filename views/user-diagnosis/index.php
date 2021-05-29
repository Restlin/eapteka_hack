<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserDiagnosisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="user-diagnosis-index">

    <?php Pjax::begin(); ?>

    <div class="col-md-12">
        <div class="rowCenter">
            <h3>Диагнозы</h3>
            <?= Html::a('Добавить', ['user-diagnosis/create'], ['class' => 'btn btn-sm btn-hmetac btn-success']) ?>
        </div>
        <br />
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => 'view',
        ]) ?>

    </div>

    <?php Pjax::end(); ?>

</div>
