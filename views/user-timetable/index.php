<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserTimetableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $types array */

$this->title = 'Расписание';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-timetable-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php Pjax::begin(); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => 'view',
        'viewParams' => ['types' => $types],
    ]) ?>

    <?php Pjax::end(); ?>

</div>
