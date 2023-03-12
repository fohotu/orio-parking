<?php

use yii\helpers\Html;
use yii\bootstrap5\Tabs;
use yii\widgets\ActiveForm;
//use kartik\date\DatePicker;
use yii\jui\DatePicker;
/** @var yii\web\View $this */
/** @var common\models\Employee $model */

$this->title = 'Обновить сотрудника: ' . $model->id;
?>
<div class="employee-update">
<?php $form = ActiveForm::begin(); ?>
<div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>

        <?php 
        echo $form->field($model->profile, 'name')->textInput();
        echo $form->field($model->profile, 'last_name')->textInput(); 
        echo $form->field($model->profile, 'patronymic')->textInput();
        echo $form->field($model->profile, 'phone_number')->textInput();
        echo $form->field($model, 'tenant_id')->hiddenInput()->label('');
        
        
        ?> 
<?php ActiveForm::end(); ?>

</div>
