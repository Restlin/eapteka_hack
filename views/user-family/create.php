<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserFamily */
/* @var $users array */
/* @var $roles array */

$this->title = 'Добавить родственника';
$this->params['breadcrumbs'][] = ['label' => 'Личный кабинет', 'url' => ['user/view', 'id' => $model->user_id1]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-family-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'users' => $users,
        'types' => $roles

    ]) ?>

</div>
