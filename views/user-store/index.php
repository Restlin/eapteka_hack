<?php

use app\models\UserStore;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserStoreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $items array */
/* @var $users array */
/* @var $modes array */

$this->title = 'Моя аптечка';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-store-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Купить', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel, 'items' => $items, 'users' => $users, 'modes' => $modes]); ?>

    <?= \yii\bootstrap\Tabs::widget([
        'items' => [
            [
                'label' => 'Домой',
                'content' => ListView::widget([
                    'dataProvider' => $dataProvider2,
                    'itemOptions' => ['class' => 'col-sm-6 col-md-4'],
                    'itemView' => '_item',
                ]),
            ],
            [
                'label' => 'В дорогу',
                'content' => ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemOptions' => ['class' => 'col-sm-6 col-md-4'],
                    'itemView' => '_item',
                ]),
            ],            
        ],
    ]) ?>

    <?php Pjax::end(); ?>

</div>
