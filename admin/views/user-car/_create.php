<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

?>
<div class="user-car-create">

    <?php $form = ActiveForm::begin([
        'action'=>['create','id'=>$model->user_id], 
    ]); ?>

    <?= $form->field($model, 'car_number')->textInput() ?>

    <?= $form->field($model, 'car_model')->textInput() ?>

    <?= $form->field($model, 'car_color')->textInput() ?>
    <?= $form->field($model, 'car_vin')->textInput() ?>
    <?php 
   echo $form->field($model, 'start_date')->widget(DatePicker::classname(),[
                                     'name' => 'start_from',
                                     'options' => ['placeholder' => 'Select issue date ...'],
                                     'pluginOptions' => [
                                        'format'=>'dd-mm-yyyy'
                                    ]
                                ]
                        );
    echo $form->field($model, 'end_date')->widget(DatePicker::classname(),[
                                'name' => 'end_date',
                                'options' => ['placeholder' => 'Select issue date ...'],
                                'pluginOptions' => [
                                    'format' => 'dd-mm-yyyy',
                                ]
                           ]
                                )

                    ?>   

    <div class="form-group">
        <?= Html::submitButton('Сохранять', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
