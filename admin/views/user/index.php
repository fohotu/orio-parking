<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;


?>


<div class="user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'headerContainer' => ['style' => 'top:50px', 'class' => 'kv-table-header'], // offset from top
        'floatHeader' => true, // table header floats when you scroll
        'floatPageSummary' => true, // table page summary floats when you scroll
        'floatFooter' => false, // disable floating of table footer
      //  'pjax' => true, // pjax is set to always false for this demo
        // parameters from the demo form
        'responsive' => false,
        'bordered' => true,
        'striped' => false,
        'condensed' => true,
        'hover' => true,
        'showPageSummary' => true,
        'panel' => [
           // 'heading' => '<i class="fas fa-book">Арендаторы</i>  ',
            'type' => 'default',
        ],
        'columns' => [
            [
                'attribute'=>'fullName',
                'label' => 'Полное имя',
            ],
            [
                'attribute' => 'username',
                'label' => 'Логин'
            ],
            [
                'attribute'=>'email',
                'label' =>'Электронная почта'

            ],
            [
                'attribute'=>'status',
                'label'=>'Статус',
                'value' =>function($model){
                    return $model->status;
                }, 
            ], 
            //'created_at',
            //'updated_at',
            //'verification_token',
            //'tenant_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                 'template' => '{update} {delete}',
                 'buttons'=>[
                    'update'=>function($url,$model,$key){
                        return "<a href='".$url."' class='btn btn-success'>Обновить</a>";
                    },  
                    'delete' => function($url,$model,$key){
                        return "<a href='".$url."'  data-method='post' data-confirm='". Yii::t('kvgrid', 'Are you sure to delete this 1{key}?',['item' => $key])."' class='btn btn-success'>Удалить</a>";
                    }
                 ]
            ],
        ],
        'toolbar' =>  [
            [
                'content' =>
                    Html::a('Add New', ['create'], ['class' => 'btn btn-success'])
                    .Html::a('<i class="fas fa-redo"></i>', ['grid-demo'], [
                        'class' => 'btn btn-outline-secondary',
                        'title'=>Yii::t('app', 'Reset Grid'),
                        'data-pjax' => 0, 
                    ]), 
                'options' => ['class' => 'btn-group mr-2 me-2']
            ],
          //  '{export}',
            '{toggleData}',
        ],
        'toggleDataContainer' => ['class' => 'btn-group mr-2 me-2'],
        'persistResize' => false,
    ]); ?>


</div>
