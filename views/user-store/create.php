<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserStore */
/* @var $items array */
/* @var $users array */
/* @var $modes array */

$this->title = 'Добавить лекарство';
$this->params['breadcrumbs'][] = ['label' => 'Моя аптечка', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-store-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items,
        'users' => $users,
        'modes' => $modes,
    ]) ?>

</div>
