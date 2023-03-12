<?php 
use Yii\helpers\Html;
foreach($model->car as $car){
?>
    <?php echo Html::label('Car Number')?>
    <?php echo  Html::input('text', 'car_number', $car->car_number, ['class' => 'form-control']) ?>
    <?php echo Html::label('Car Model')?>
    <?php echo  Html::input('text', 'car_model', $car->car_number, ['class' => 'form-control']) ?>
    <?php echo Html::label('Car Color')?>
    <?php echo Html::input('text', 'car_color', $car->car_color, ['class' => 'form-control']) ?>
    <?php echo Html::label('Car Vin')?>
    <?php echo  Html::input('text', 'car_vin', $car->car_vin, ['class' => 'form-control']) ?>
<?php
}
?>