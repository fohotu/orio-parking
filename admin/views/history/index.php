<?php

use common\models\ParkingHistory;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\ParkingHistorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Parking Histories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parking-history-index">

  
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'id' => 'kv-grid-history',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'headerContainer' => ['style' => 'top:50px', 'class' => 'kv-table-header'], // offset from top
       // 'floatHeader' => true, // table header floats when you scroll
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
                'attribute' => 'company',
                'label'=>'Арендатор',
                'value' => function($model){
                        if($model->car->employee){
                            return $model->car->employee->company->tenant_name;
                        }
                }
            ],
            [
                'attribute' => 'employee',
                'label' => 'Сотрудник',
                'value' => function($model){
                    if($model->car->employee){
                       return  $model->car->employee->fullName;
                    }
                }
            ],
            [
                'attribute'=>'car_number',
                'label' => 'Номер машины',
                'value' => function($model){
                    return $model->car->car_number;
                }
            ],
            [
                'attribute' => 'enter_date',
                'label' => 'Дата въезда',
                'filterType' => GridView::FILTER_DATE,
             
                'filterWidgetOptions' => [
                    //'convertFormat'=>true,
                    'pluginOptions' => [
                        'format'=>'dd-mm-yyyy'
                    ]
                ],
                'value' => function($model){
                    return Date("d-m-Y  H:i:s",$model->enter_date);
                }
            ],
            [
                'attribute'=>'exit_date',
                'label' => 'Дата выезда',
                'value' => function($model){
                    return Date("d-m-Y  H:i:s",$model->enter_date);
                },
            ],
           
            
            /*[
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ParkingHistory $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],*/
        ],
    ]); ?>


</div>
