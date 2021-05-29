<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserFamily */
/* @var $form yii\widgets\ActiveForm */
/* @var $users array */
/* @var $roles array */
?>

<div class="user-family-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id2')->dropDownList($users) ?>

    <?= $form->field($model, 'role')->dropDownList($roles) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
