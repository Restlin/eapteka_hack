<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserTimetableSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-timetable-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'item_id') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'complete')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-sm btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-sm btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
