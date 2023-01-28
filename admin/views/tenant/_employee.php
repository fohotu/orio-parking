<?php 
use yii\bootstrap5\Modal;
?>

<div class='tab_content'>
    <div class='tab_button'>
<?php 
    Modal::begin([
      'title' => 'Добавить сотрудника',
      'toggleButton' => ['label' => 'Добавить сотрудника','class'=>'btn btn-info'],
  ]);
  ?>
  <?php 
  
    echo $this->render('_employee_form',['employee'=>$employee]);

 ?>
 <?php
   Modal::end();
 ?>
    </div>

</div>