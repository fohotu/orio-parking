<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\UserCar $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-car-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model->car, 'car_model')->textInput() ?>
    <?= $form->field($model->car, 'car_number')->textInput() ?>
    <?= $form->field($model->car, 'car_color')->textInput() ?>

    <?= $form->field($model, 'start_date')->textInput() ?>
    <?= $form->field($model, 'end_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
