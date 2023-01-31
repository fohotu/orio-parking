<?php 
use Yii\helpers\Html;
foreach($model->car as $car){
?>
    <?php echo Html::label('Car Number')?>
    <?php echo  Html::input('text', 'car_number', $car->car_number, ['class' => 'form-control']) ?>
    <?php echo Html::label('Car Description')?>
    <?php echo Html::input('text', 'description', $car->description, ['class' => 'form-control']) ?>
<?php
}
?>