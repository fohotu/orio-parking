<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
?>
<div class="site-login">
    <div class="mt-5 col-lg-6">
     
       
        <?php $form = ActiveForm::begin(['id' => 'Role-form']); ?>

            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'displayname')->textInput(['autofocus' => true]) ?>

          
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
