<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserStoreSearch */
/* @var $form yii\widgets\ActiveForm */
/* @var $items array */
/* @var $users array */
?>

<div class="user-store-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'user_id')->dropDownList($users) ?>

    <?= $form->field($model, 'item_id')->dropDownList($items) ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'target_id')->dropDownList($users) ?>

    <?php // echo $form->field($model, 'regular')->checkbox() ?>

    <?php // echo $form->field($model, 'mode') ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сброс', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
