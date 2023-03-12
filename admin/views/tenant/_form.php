<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap5\Tabs;

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
         echo Tabs::widget([
            'items' => [
                         [
                             'label' => 'Организация',
                             'content' => '
                             <div class="card">
                               <div class="card-body">'
                                .$form->field($model, 'tenant_name')->textInput(['maxlength' => true])
                                .$form->field($model, 'tin')->textInput(['maxlength' => true])
                                .$form->field($model, 'bic')->textInput(['maxlength' => true])
                                .$form->field($model, 'address')->textarea(['rows' => 6])
                                .$form->field($model, 'cost_per_hour')->textInput() 
                                .$form->field($model, 'allocated_spaces_count')->textInput()
                            .'</div>
                            </div>
                            ',
                             'active' => true
                         ],
                         [
                            'label' => 'Реквизиты банка',
                            'content' => '
                            <div class="card">
                              <div class="card-body">'
                                .$form->field($model, 'bank_name')->textInput()
                                .$form->field($model, 'checking_account')->textInput(['maxlength' => true])    
                              .'
                              </div>
                              </div>
                              '  
                            ,
                        ],

                        [
                            'label' => 'Тариф',
                            'content' =>$this->render('_rate',['model'=>$model,'form'=>$form]),
                        ],
                ]
         ]);
    ?>



   

    <?php ActiveForm::end(); ?>

</div>
