<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserDiagnosis */
/* @var $diagnosises array */

$this->title = 'Добавить диагноз';
$this->params['breadcrumbs'][] = ['label' => 'Личный кабинет', 'url' => ['user/view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-diagnosis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'diagnosises' => $diagnosises
    ]) ?>

</div>
