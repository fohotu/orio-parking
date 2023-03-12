<?php

use common\models\Tenant;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\TenantSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Арендаторы';


?>
<div class="tenant-index">



    <?php 
    $gridColumns = [
        'tenant_name',
        'tin',
        'address:ntext',
        'allocated_spaces_count', 
        
        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, Tenant $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
             },
             'buttons'=>[
                'view'=>function($url,$model,$key){
                    return Html::a('Сотрудники',['employee/index','id'=>$model->id],['class'=>'btn btn-success' ],['class'=>'glyphicon glyphicon-users']);
                 
                },
                'update'=>function($url,$model,$key){
                    return "<a href='".$url."' class='btn btn-success'>Обновить</a>";
                },  
                'delete' => function($url,$model,$key){
                    return "<a href='".$url."'  data-method='post' data-confirm='". Yii::t('kvgrid', 'Are you sure to delete this 1{key}?',['item' => $key])."' class='btn btn-success'>Удалить</a>";
                }
             ]
        ],
    ];

    ?>
<?php

    echo GridView::widget([
        'id' => 'kv-grid-tenant',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns, // check this value by clicking GRID COLUMNS SETUP button at top of the page
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
        // set export properties
        /*'export' => [
            'fontAwesome' => true
        ],
        'exportConfig' => [
            'html' => [],
            'csv' => [],
            'txt' => [],
            'xls' => [],
            //'pdf' => [],
            'json' => [],
        ],
        */
        // set your toolbar
        'toolbar' =>  [
            [
                'content' =>
                    Html::a("<i class='fas fa-plus-square'></i>", ['create'], ['class' => 'btn btn-success'])
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
        'toggleDataOptions' => ['minCount' => 10],
        //'itemLabelSingle' => 'book',
       // 'itemLabelPlural' => 'books'
    ]);
    ?>



</div>
