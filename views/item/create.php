<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var $groups array */
/* @var $substances array */
/* @var $foodModes array */
/* @var $perDayModes array */

$this->title = 'Создать препарат';
$this->params['breadcrumbs'][] = ['label' => 'Препараты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'groups' => $groups,
        'substances' => $substances,
        'foodModes' => $foodModes,
        'perDayModes' => $perDayModes
    ]) ?>

</div>
