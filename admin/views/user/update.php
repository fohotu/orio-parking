<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\bootstrap5\Tabs;
use common\models\Tenant;

/** @var yii\web\View $this */
/** @var common\models\Tenant $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tenant-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php 
        echo $form->field($model->profile, 'name')->textInput(['maxlength' => true]);
        echo $form->field($model->profile, 'last_name')->textInput(['maxlength' => true]);
        echo $form->field($model->profile, 'patronymic')->textInput(['maxlength' => true]);
        echo $form->field($model->profile, 'phone_number')->textInput(['maxlength' => true]);
    ?>
    <?php ActiveForm::end(); ?>
</div>
