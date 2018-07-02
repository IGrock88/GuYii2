<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\SearchEvent */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Доступные события';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'text:ntext',
            'dt:datetime',
            [
                'label' => 'Владелец',
                'value' => 'creator.name'
            ],
            'created_at:datetime',
        ]
    ]); ?>
    <?php Pjax::end(); ?>
</div>
