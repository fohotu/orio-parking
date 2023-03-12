<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Employee $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'lastname')->textInput() ?>

    <?= $form->field($model, 'patronymic')->textInput() ?>

    <?= $form->field($model, 'phone_number')->textInput() ?>
    <?= $form->field($model, 'car_number')->textInput() ?>
    <?= $form->field($model, 'car_model')->textInput() ?>
    <?= $form->field($model, 'car_color')->textInput() ?>
    <?= $form->field($model, 'car_vin')->textInput() ?>
    <?= $form->field($model, 'pass_from')->textInput() ?>
    <?= $form->field($model, 'pass_to')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
