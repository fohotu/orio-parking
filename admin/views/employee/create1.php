<?php

use yii\helpers\Html;

use yii\bootstrap5\Tabs;
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
<?php 
         echo Tabs::widget([
            'items' => [
                         [
                             'label' => 'Сотрудник',
                             'content' => $form->field($model, 'name')->textInput()
                             .$form->field($model, 'lastname')->textInput() 
                            .$form->field($model, 'patronymic')->textInput()
                            .$form->field($model, 'phone_number')->textInput()
                            .$form->field($model, 'tenant_id')->hiddenInput()->label(''),
                             'active' => true
                         ],
                         [
                            'label' => 'Автомобиль',
                            'content' =>$form->field($model, 'car_number')->textInput()
                            .$form->field($model, 'car_model')->textInput()
                            .$form->field($model, 'car_color')->textInput()
                            .$form->field($model, 'car_vin')->textInput(),
                        ],
                        [
                            'label' => 'Пропуск',
                            'content' =>$form->field($model, 'pass_from')->widget(DatePicker::classname(),[
                                     'name' => 'pass_from',
                                     //'value' => date('dd-m-Y', time()),
                                     'options' => ['placeholder' => 'Select issue date ...'],
                                     'pluginOptions' => [
                                        'format'=>'dd-mm-yyyy'
                                       // 'todayHighlight' => true
                                    ]
                                ]
                            )
                            .$form->field($model, 'pass_to')->widget(DatePicker::classname(),[
                                'name' => 'pass_to',
                                //'value' => date('dd-mm-yyyy', strtotime('+2 days')),
                                'options' => ['placeholder' => 'Select issue date ...'],
                                'pluginOptions' => [
                                    'format' => 'dd-mm-yyyy',
                                    //'todayHighlight' => true,
                                ]
                           ]
                       ),
                        ],
                ]
         ]);
    ?>
<?php ActiveForm::end(); ?>

    <?php 
    
    $this->render('_form', [
        'model' => $model,
    ]) 
    
    ?>

</div>
