<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\SearchEvent */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мои расшаренные события';
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
                'label' => 'users',
                'value' => function(\app\models\Event $model){
                    $users = $model->getAccessedUsers()->select('name')->column();
                    return $users ? join(', ', $users) : '';
                }

],
            'created_at:datetime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {unShareAll}',
                'buttons' => [
                    'unShareAll' => function ($url, $model, $key) {
                        return Html::a(\yii\bootstrap\Html::icon('minus-sign'), ['access/unShareAll', 'eventId' => $model->id]);
                    }
                ]
            ],
        ]
    ]); ?>
    <?php Pjax::end(); ?>
</div>
