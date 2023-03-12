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
use yii\bootstrap4\Modal;

/** @var yii\web\View $this */
/** @var common\models\search\EmployeeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Сотрудники';

?>
<div class="employee-index">

<?php
  Modal::begin([
       'id'=>'add-employee-modal', 
  ]);

  echo $this->render('_create',[
    'model'=>$model,
  ]);

  Modal::end();
 ?>

<?php

  Modal::begin([
       'id'=>'limit-employee-modal', 
  ]);

?>
<form method="post" action="<?php echo Url::to(['rate'])?>">
    <input type="hidden" name="employee" id="employee" value=""/>
    <input type="hidden" name="<?php echo Yii::$app->request->csrfParam?>" value="<?php echo Yii::$app->request->csrfToken?>" />
    <select class="form-control"  name="limit" id="limit_value">
        <option value="rate" >По тарифу</option>  
        <option value="unlim">Безлимитный</option>  
    </select>
    <button class="btn btn-success" type="submit">Save</button>
</form>
<?php 

  Modal::end();
 ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => 'employee-grid',
        'rowOptions'=>function($model){
            if($model->id % 3==0)
            return ['class' => 'kartik-sheet-style-123'];
        },
        'columns' => [
            [
                'attribute' => 'fullName',
                'label' => 'ФИО',
                //'filter'=>'',
                'value' => function($model){
                    if($model->profile){
                        $rate = "";
                        if($model->unlime_rate){
                            $rate = "*";
                        }
                        return $rate.$model->fullName;
                    }
                }
            ],
            [
                'attribute' => 'created_at_string',
                'label' => 'Дата регистрации',
                'filterType' => GridView::FILTER_DATE,
             
                'filterWidgetOptions' => [
                    //'convertFormat'=>true,
                    'pluginOptions' => [
                        'format'=>'dd-mm-yyyy'
                    ]
                ],
                'value' => function($model){
                    return $model->created_at_string;
                }
            ],
            //'created_by',
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
                'attribute'=>'balance',
                'label' => 'остаток',
                'value' => function($model){
                    $sim = "";
                    if($model->id % 3==0)
                    {
                        $sim = "-";
                    }
                    return $sim.rand(100,500);
                },
                

            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{update} {delete} {car} {unlime}',
                'urlCreator' => function ($action, Employee $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                 'buttons'=>[
                    /*'view'=>function($url,$model,$key){
                        return Html::a('employees',$url,['class'=>'btn btn-info' ],['class'=>'glyphicon glyphicon-users']);
                     
                    },
                    */
                    'update'=>function($url,$model,$key){
                        return "<a href='".$url."' class='btn btn-success'>Обновить</a>";
                        //return Html::a('update',['update','id'=>$model->id,'tenant'=>$model->tenant_id],['class'=>'btn btn-info' ]);
                    },  
                    'delete' => function($url,$model,$key){
                        return "<a href='".$url."'  data-method='post' data-confirm='". Yii::t('kvgrid', 'Are you sure to delete this 1{key}?',['item' => $key])."' class='btn btn-success'>Удалить</a>";
                        
                    },
                    'car'=>function($url,$model,$key){
                        return Html::a('Машина',['/user-car/index','id'=>$model->id],['class'=>'btn btn-success' ],['class'=>'glyphicon glyphicon-users']);
                     
                    },
                    'unlime' => function ($url,$model,$key){
                        return "<button data-employee='$model->id' data-value='$model->unlime_rate' class='btn btn-success unlime'>*</button>";
                    }
                 ]
            ],
        ],
        'headerContainer' => ['style' => 'top:50px', 'class' => 'kv-table-header'], // offset from top
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
                    Html::a("<i class='fas fa-plus-square'></i>", ['create','tenant'=>Yii::$app->request->get('id')], ['class' => 'btn btn-success'])
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

<?php 
$js = "
    $('.unlime').click(function(){

        let employee=$(this).attr('data-employee');
        let value = $(this).attr('data-value');

        $('#employee').val(employee);
        if(value==1){
            $('#limit_value').val('unlim').change();
        }else{
            $('#limit_value').val('rate').change();
        }


        $('#limit-employee-modal').modal('show');
    });
";
$this->registerJs($js);
?>