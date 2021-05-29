<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PrescriptionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prescription-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'author_id') ?>

    <?= $form->field($model, 'patient_id') ?>

    <?= $form->field($model, 'diagnosis_id') ?>

    <?= $form->field($model, 'date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-sm btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-sm btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
