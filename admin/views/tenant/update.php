<?php

use yii\helpers\Html;
use aryelds\sweetalert\SweetAlert;


use yii\widgets\ActiveForm;
use yii\bootstrap5\Tabs;

use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var common\models\Tenant $model */

$this->params['breadcrumbs'][] = ['label' => 'Tenants', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tenant-update">

<div class="site-form">

    <?php $form = ActiveForm::begin(); ?>


        <?php 
         echo Tabs::widget([
            'items' => [
                         [
                             'label' => 'Организация',
                             'content' => '
                             <div class="card">
                               <div class="card-body">'
                               .$form->field($model, 'tenant_name') 
                                .$form->field($model, 'tin') 
                                .$form->field($model, 'bic') 
                               .$form->field($model, 'address') 
                               .$form->field($model, 'allocated_spaces_count') 
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
                              .$form->field($model, 'bank_name') 
                                .$form->field($model, 'checking_account')
                              .'
                              </div>
                              </div>
                              '  
                            ,
                        ],

                        [
                            'label' => 'Тариф',
                            'content' =>
                           
                              
                                    $form->field($model, 'day_rate')->checkbox(['id' => 'day_rate','class'=>'rate_on','data-on'=>'day-on']) 
                                    .$form->field($model, 'cost_per_day')->textInput(['class'=>'day-on form-control','disabled'=>!$model->day_rate]) 
                                    
                                    .$form->field($model, 'hour_rate')->checkbox(['id' => 'hour_rate','class'=>'rate_on','data-on'=>'hour-on']) 
                                    .$form->field($model, 'cost_per_hour')->textInput(['class'=>'hour-on form-control','disabled'=>!$model->hour_rate])
                        ],
                ]
         ]);
    ?>

         
       

    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-form -->


<?php 
$js = "
         $('.rate_on').click(function(){
            let c ='.' + $(this).attr('data-on');
            let check = $(this).is(':checked');
            $(c).prop('disabled',!check);

         });

";

$this->registerJs($js);

?>


</div>
