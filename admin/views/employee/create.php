<?php

use yii\helpers\Html;

use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/** @var yii\web\View $this */
/** @var common\models\Employee $model */

$this->title = 'Create Employee';
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-create">

<?php $form = ActiveForm::begin(); ?>
<div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>


    <?php echo $form->field($model, 'name')->textInput();?>
    <?php echo $form->field($model, 'lastname')->textInput();?>
    <?php echo $form->field($model, 'patronymic')->textInput();?>
    <?php echo $form->field($model, 'phone_number')->textInput();?>
    <?php echo $form->field($model, 'tenant_id')->hiddenInput()->label('');?>
<?php ActiveForm::end(); ?>

    <?php 
    /*
    $this->render('_form', [
        'model' => $model,
    ]) 

    */
    
    ?>

</div>
