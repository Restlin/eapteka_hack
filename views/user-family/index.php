<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserFamilySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $roles array */

?>
<div class="user-family-index">

    <?php Pjax::begin(); ?>

    <div class="col-md-12">
        <div class="rowCenter">
            <h3>Родственники</h3>
            <?= Html::a('Добавить', ['user-family/create', 'user_id' => $searchModel->user_id1], ['class' => 'btn btn-sm btn-hmetac btn-success']) ?>
        </div>
        <br />
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => 'view',
            'viewParams' => ['roles' => $roles],
        ]) ?>

    </div>

    <?php Pjax::end(); ?>



</div>
