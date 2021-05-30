<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserStoreSearch */
/* @var $form yii\widgets\ActiveForm */
/* @var $items array */
/* @var $users array */
/* @var $modes array */
?>

<div class="user-store-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row">
        <div class="col-md-3 col-xs-6">
            <?= $form->field($model, 'target_id')->dropDownList($users) ?>
        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-sm btn-primary']) ?>
        <?= Html::resetButton('Сброс', ['class' => 'btn btn-sm btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
