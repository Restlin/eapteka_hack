<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var $form yii\widgets\ActiveForm */
/* @var $groups array */
/* @var $substances array */
/* @var $foodModes array */
/* @var $perDayModes array */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_id')->dropDownList($groups) ?>

    <?= $form->field($model, 'substance_id')->dropDownList($substances) ?>

    <?= $form->field($model, 'dose')->textInput() ?>

    <?= $form->field($model, 'food_mode')->dropDownList($foodModes) ?>

    <?= $form->field($model, 'per_day')->dropDownList($perDayModes) ?>

    <?= $form->field($model, 'temp_min')->textInput() ?>

    <?= $form->field($model, 'temp_max')->textInput() ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
