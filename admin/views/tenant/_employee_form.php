<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\date\DatePicker;

$form = ActiveForm::begin(); 
 
  echo $form->field($employee, 'name')->textInput(['maxlength' => true]);
  echo $form->field($employee, 'lastname')->textInput(['maxlength' => true]);
  echo $form->field($employee, 'patronymic')->textInput(['maxlength' => true]);
  echo $form->field($employee, 'car_number')->textInput(['rows' => 6]);
  echo $form->field($employee, 'pass_from')->widget(DatePicker::classname(),[
    'pluginOptions' => [
      'autoclose' => true,
      'format' => 'dd-mm-yyyy'
    ]
  ]);
  echo $form->field($employee, 'pass_to')->widget(DatePicker::classname(),[
    'pluginOptions' => [
      'autoclose' => true,
      'format' => 'dd-mm-yyyy'
    ]
  ]);

  echo $form->field($employee, 'car_description')->textarea(['rows' => 3]);
  echo $form->field($employee, 'phone_number')->textINput(['rows' => 6]);

   echo Html::submitButton('Сохранить', ['class' => 'btn btn-success']);

  ActiveForm::end();

  ?>