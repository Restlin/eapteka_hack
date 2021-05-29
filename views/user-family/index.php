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

    <h1>Родственники</h1>

    <p>
        <?= Html::a('Добавить родственника', ['user-family/create', 'user_id' => $searchModel->user_id1], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => 'view',
        'viewParams' => ['roles' => $roles],
    ]) ?>

    <?php Pjax::end(); ?>

</div>
