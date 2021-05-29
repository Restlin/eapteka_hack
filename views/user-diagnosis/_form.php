<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserDiagnosis */
/* @var $form yii\widgets\ActiveForm */
/* @var $diagnosises array */
?>

<div class="user-diagnosis-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'diagnosis_id')->dropDownList($diagnosises) ?>

    <?= $form->field($model, 'regular')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
