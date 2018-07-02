<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Event */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['my']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'text:ntext',
            'dt',
            'creator_id',
            'created_at',
        ],
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'user.name',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{deleteOneShare}',
                'buttons' => [
                    'deleteOneShare' => function ($url, $model, $key) {
                        return Html::a(\yii\bootstrap\Html::icon('minus-sign'), ['access/delete', 'accessId' => $model->id]
                        ,
                        [
                            'data' => [
                                'confirm' => 'Вы действительно хотите удалить доступ к событию?',
                                'method' => 'post',
                            ]
                        ]);
                    }
                ]
            ],
        ]
    ]); ?>

</div>
