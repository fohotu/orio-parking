<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;


/** @var yii\web\View $this */
/** @var common\models\UserCar $model */


$this->title = 'Автомобили сотрудника';
?>

<div class="user-car-update">


<div class="user-car-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($formModel, 'car_model')->textInput(['value'=>$model->car->car_model])->label('Модель') ?>
    <?= $form->field($formModel, 'car_number')->textInput(['value'=>$model->car->car_number])->label('Номер') ?>
    <?= $form->field($formModel, 'car_color')->textInput(['value'=>$model->car->car_color])->label('Цвет') ?>


    <?=$form->field($formModel, 'start_date')->widget(DatePicker::classname(),[
                                     'name' => 'start_date',
                                     'options' => ['value'=>$model->startDateText,'placeholder' => 'Select issue date ...'],
                                     'pluginOptions' => [
                                        'format'=>'dd-mm-yyyy'
                                    ]
                                ]
                        )->label('Пропуск с')
     ?>
    

    <?=$form->field($formModel, 'end_date')->widget(DatePicker::classname(),[
                                     'name' => 'end_date',
                                     'options' => ['value'=>$model->endDateText,'placeholder' => 'Select issue date ...'],
                                     'pluginOptions' => [
                                        'format'=>'dd-mm-yyyy'
                                    ]
                                ]
                        )->label('Пропуск по')
     ?>                   

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
    

</div>
