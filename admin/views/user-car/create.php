<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;


/** @var yii\web\View $this */
/** @var common\models\UserCar $model */

$this->title = 'Create User Car';
$this->params['breadcrumbs'][] = ['label' => 'User Cars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-car-create">

    <?php $form = ActiveForm::begin(); ?>

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
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
