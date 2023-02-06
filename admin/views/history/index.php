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
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        
            [
                'attribute' => 'company',
                'value' => function($model){
                        if($model->car->employee){
                            return $model->car->employee->company->tenant_name;
                        }
                }
            ],
            [
                'attribute' => 'employee',
                'value' => function($model){
                    if($model->car->employee){
                       return  $model->car->employee->fullName;
                    }
                }
            ],
            [
                'attribute'=>'car_number',
                'value' => function($model){
                    return $model->car->car_number;
                }
            ],
            [
                'attribute' => 'enter_date',
                'label' => 'Дата регистрации',
                'filterType' => GridView::FILTER_DATE,
             
                'filterWidgetOptions' => [
                    //'convertFormat'=>true,
                    'pluginOptions' => [
                        'format'=>'dd-mm-yyyy'
                    ]
                ],
                'value' => function($model){
                    return $model->enter_date;
                }
            ],
            'exit_date',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ParkingHistory $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
