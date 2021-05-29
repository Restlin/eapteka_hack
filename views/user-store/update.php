<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserStore */
/* @var $items array */

$this->title = 'Редактировать: ' . $model->item->name;
$this->params['breadcrumbs'][] = ['label' => 'Мои лекарства', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="user-store-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items,
    ]) ?>

</div>
