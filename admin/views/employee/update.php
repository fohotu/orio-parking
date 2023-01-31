<?php

use yii\helpers\Html;
use yii\bootstrap5\Tabs;
use yii\widgets\ActiveForm;
//use kartik\date\DatePicker;
use yii\jui\DatePicker;
/** @var yii\web\View $this */
/** @var common\models\Employee $model */

$this->title = 'Update Employee: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="employee-update">
<?php $form = ActiveForm::begin(); ?>
<div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>
    
<?php 
         echo Tabs::widget([
            'items' => [
                         [
                             'label' => 'Сотрудник',
                             'content' => $form->field($model->profile, 'name')->textInput()
                             .$form->field($model->profile, 'last_name')->textInput() 
                            .$form->field($model->profile, 'patronymic')->textInput()
                            .$form->field($model->profile, 'phone_number')->textInput()
                            .$form->field($model, 'tenant_id')->hiddenInput()->label(''),
                            'active' => true,  
                         ],
                         [
                            'label' => 'Автомобиль',
                            'content'=> $this->render('_car_form',['model'=>$model,'form'=>$form]),
                         ], 
                        [
                            'label' => 'Пропуск',
                            'content' =>$form->field($model->userParking, 'start_date')->widget(DatePicker::classname(),[
                                    'name' => 'pass_from',
                                    'dateFormat'=>'dd-MM-yyyy',
                                    //'value' => date('dd-m-Y', $model->userParking->start_date),
                                     'options' => ['placeholder' => 'Select issue date ...','class'=>'form-control'],
                                     'clientOptions' => [
                                        //'defaultDate'=>date('dd-MM-yyyy', $model->userParking->start_date),
                                       //'todayHighlight' => true
                                    ]
                                ]
                            )
                            .$form->field($model->userParking, 'end_date')->widget(DatePicker::classname(),[
                                'name' => 'pass_to',
                                'dateFormat'=>'dd-MM-yyyy',
                                'options' => ['placeholder' => 'Select issue date ...','class'=>'form-control'],
                               // 'value' => 'U', 
                                'clientOptions' => [
                                   // 'defaultDate'=>date('dd-MM-yyyy', $model->userParking->end_date),
                                   // 'todayHighlight' => true
                                ]
                           ]
                       ),
                      
                        ],
                ]
         ]);
    ?>
<?php ActiveForm::end(); ?>

</div>
