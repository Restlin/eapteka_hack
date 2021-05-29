<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserStore */
/* @var $form yii\widgets\ActiveForm */
/* @var $items array */
/* @var $users array */

?>

<div class="user-store-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList($users) ?>

    <?= $form->field($model, 'item_id')->dropDownList($items) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'target_id')->dropDownList($users) ?>

    <?= $form->field($model, 'regular')->checkbox() ?>

    <?= $form->field($model, 'mode')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
