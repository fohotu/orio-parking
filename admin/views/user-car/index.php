<?php

use common\models\UserCar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\Modal;


use kartik\grid\ActionColumn;
use kartik\grid\GridView;
/** @var yii\web\View $this */
/** @var common\models\search\UserCarSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Автомобили сотрудника';
?>
<div class="user-car-index">
<?php
  Modal::begin([
      //'title' => 'Create User Car',
       'id'=>'add-car-modal', 
     // 'toggleButton' => ['label' => '+<i class="fas fa-car"></i>','class' => 'btn btn-success'],
  ]);

  echo $this->render('_create',[
    'model'=>$model,
  ]);

  Modal::end();
 ?>


<?php
  Modal::begin([
       'id'=>'update-car-modal', 
  ]);
  
?>
    <div id="update_modal_content">
    
    </div>
<?php 

  Modal::end();
 ?>


    <p>
        <?php // Html::a('Create User Car', ['create','id'=>$searchModel->user_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' =>null,// $searchModel,
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
                'label'=>'Модель',
                'attribute'=>'car_model',
                'value' => function($model){
                        return $model->car->car_model;
                    },
                ],
            [
            'label' => 'Номер',   
            'attribute'=>'car_number',
            'value' => function($model){
                    return $model->car->car_number;
                },
            ],
            [
                'label'=>'Цвет',
                'attribute'=>'car_color',
                'value' => function($model){
                        return $model->car->car_color;
                },
            ],
            [
                'label'=>'Пропуск с',
                'attribute'=>'start_date',
                'enableSorting' => false,
                'value' => function($model){
                        return $model->startDateText;
                },
            ],
            [
                'label'=>'Пропуск по',
                'attribute'=>'end_date',
                'enableSorting' => false,

                'value' => function($model){
                        return $model->endDateText;
                },
            ],
            [
                //'label'=>'#',
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, UserCar $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                 'template' => '{update} {delete}',   
                 'buttons'=>[
                    'update-modal'=>function($url,$model){
                        return "<button onClick='' class='update-modal-btn' data-id='".$model->id."'>upd</button>";
                    }
                ],
                'buttonOptions'=>[
                    'class'=>'btn btn-success',
                ],
            ],
        ],
        'toolbar' =>  [
            [
                'content' =>
                    "<button id='addG' class = 'btn btn-success' > +<i class='fas fa-car'></i></button>".
                   // Html::button('Add New', ['class' => 'btn btn-success','id'=>'add-car-btn','onClick'=>'al()'])
                    Html::a('<i class="fas fa-redo"></i>', ['grid-demo'], [
                        'class' => 'btn btn-outline-secondary',
                        'title'=>Yii::t('app', 'Reset Grid'),
                        'data-pjax' => 0, 
                    ])
                    
                    , 
                'options' => ['class' => 'btn-group mr-2 me-2']
            ],
          //  '{export}',
            '{toggleData}',
        ],
    ]); ?>


</div>

<?php 
$url = Url::to(['ajax-update']);
$js = "
    $(document).on('click','#addG',()=>{
        $('#add-car-modal').modal('show');
    });

   

    $(document).on('click','.update-modal-btn',(ev)=>{
        let id = $(ev.target).attr('data-id');
        
        
        $.ajax({
            url: '$url&id='+id,
          }).done(function(data) {
            $( '#update_modal_content' ).html(data);
          });
        $('#update-car-modal').modal('show');
    });

    //
";

$this->registerJs($js);

?>