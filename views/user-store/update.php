<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserStore */
/* @var $items array */
/* @var $users array */
/* @var $modes array */

$this->title = 'Изменить: ' . $model->item->name;
$this->params['breadcrumbs'][] = ['label' => 'Моя аптечка', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->item->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="user-store-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items,
        'users' => $users,
        'modes' => $modes,
    ]) ?>

</div>
