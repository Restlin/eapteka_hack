<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserStore */
/* @var $form yii\widgets\ActiveForm */
/* @var $items array */
/* @var $users array */
/* @var $modes array */

?>

<div class="user-store-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-12">
        <?= $form->field($model, 'item_id')->dropDownList($items) ?>
    </div>

    <div class="col-md-4 col-xs-6">
        <?= $form->field($model, 'amount')->textInput() ?>
    </div>

    <div class="col-md-4 col-xs-6">
        <?= $form->field($model, 'target_id')->dropDownList($users) ?>
    </div>

    <div class="col-md-4 col-xs-12">
        <?= $form->field($model, 'mode')->dropDownList($modes) ?>
    </div>

    <div class="col-md-12">
        <?= $form->field($model, 'regular')->checkbox() ?>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Купить', ['class' => 'btn btn-sm btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
