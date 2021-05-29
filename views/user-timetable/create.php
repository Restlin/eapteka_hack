<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserTimetable */

$this->title = 'Create User Timetable';
$this->params['breadcrumbs'][] = ['label' => 'User Timetables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-timetable-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
