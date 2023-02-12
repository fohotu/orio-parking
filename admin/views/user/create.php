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
         echo Tabs::widget([
            'items' => [
                         [
                             'label' => 'Общая',
                             'content' => $form->field($model, 'name')->textInput(['maxlength' => true])
                             .$form->field($model, 'lastname')->textInput(['maxlength' => true])
                             .$form->field($model, 'patronymic')->textInput(['maxlength' => true])
                             .$form->field($model, 'phone_number')->textInput(['maxlength' => true]),
                             'active' => true
                         ],
                         [
                            'label' => 'Авторизация',
                            'content' => $form->field($model, 'login')->textInput(['maxlength' => true])
                            .$form->field($model, 'email')->textInput(['maxlength' => true])
                            .$form->field($model, 'password')->textInput(['maxlength' => true])
                            .$form->field($model, 'repeat_password')->textInput(['maxlength' => true])
                            .$form->field($model, 'role')->dropDownList(ArrayHelper::map(Yii::$app->authManager->getRoles(),'name','name'))
                            ,
                        ],
                        [
                            'label' => 'Организация',
                            'content' => $form->field($model, 'organization')->dropDownList(ArrayHelper::map(Tenant::find()->all(),'id','tenant_name')),
                        ],
                ]
         ]);
    ?>



   

    <?php ActiveForm::end(); ?>

</div>
