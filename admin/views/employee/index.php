<?php

use common\models\Employee;
use common\models\Tenant;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
//use yii\grid\ActionColumn;
//use yii\grid\GridView;

use kartik\grid\ActionColumn;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\EmployeeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Employees';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => 'employee-grid',
        'columns' => [
            [
                'attribute' => 'fullName',
                'label' => 'ФИО',
                //'filter'=>'',
                'value' => function($model){
                    if($model->profile){
                        return $model->fullName;
                    }
                }
            ],
            [
                'attribute' => 'created_at',
                'label' => 'Дата регистрации',
                'filterType' => GridView::FILTER_DATE,
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'format'=>'dd-mm-yyyy'
                    ]
                ],
                'value' => function($model){
                    return $model->createdDate;
                }
            ],
            'created_by',
            [
                'attribute' =>'tenant_id',
                'filter' => ArrayHelper::map(Tenant::receive()->getDropDownList(),'id','tenant_name'),
                'label' => 'Организация',
                'value' => function($model){
                    if($model->company)
                        return $model->company->tenant_name;
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Employee $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                 'buttons'=>[
                    'view'=>function($url,$model,$key){
                        return Html::a('employees',$url,['class'=>'btn btn-info' ],['class'=>'glyphicon glyphicon-users']);
                     
                    },
                    'update'=>function($url,$model,$key){
                        return "<a href='".$url."' class='btn btn-info'>update</a>";
    
                    },  
                    'delete' => function($url,$model,$key){
                        return "<a href='".$url."'  data-method='post' data-confirm='". Yii::t('kvgrid', 'Are you sure to delete this 1{key}?',['item' => $key])."' class='btn btn-info'>delete</a>";
                        
                    }
                 ]
            ],
        ],
        'headerContainer' => ['style' => 'top:50px', 'class' => 'kv-table-header'], // offset from top
        'floatHeader' => true, // table header floats when you scroll
        'floatPageSummary' => true, // table page summary floats when you scroll
        'floatFooter' => false, // disable floating of table footer
        // parameters from the demo form
        'responsive' => false,
        'bordered' => true,
        'striped' => false,
        'condensed' => true,
        'hover' => true,
        'showPageSummary' => true,
        'panel' => [
            'type' => 'default',
        ],
        // set your toolbar
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
            '{toggleData}',
        ],
        'toggleDataContainer' => ['class' => 'btn-group mr-2 me-2'],
        'persistResize' => false,
        'toggleDataOptions' => ['minCount' => 10],
    
    ]); ?>


</div>
