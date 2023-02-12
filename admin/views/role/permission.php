<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

      $auth = Yii::$app->authManager;
  
?>
<div class="container">
    <?php 
        $form = ActiveForm::begin();
    ?>
        <button type="submit">save</button>
        
    <table class="table table-bordered">
        <tr>
        <td></td>
    
    <?php 
         foreach($roles as $role){
    ?>
            <td><?php echo $role->name;?></td>

    <?php 
    }
    ?>
    </tr>
    <?php 
        foreach($permissions as $k=>$v){
    ?>
        <tr>
            <td>
                <?php 
                    echo $v->name."-".$v->description;
                ?>
            </td>

            <?php 
            foreach($roles as $role){
                $checked =  isset($rolePermissions[$role->name][$k]);
                ?>
                <td> 
                    <?php 
                        echo Html::checkbox("role[$role->name][$v->name]", $checked);
                    ?> 
                </td>
            <?php 
                }
            ?>
        </tr>
    <?php 
        }
    ?>
        </table>
    <?php 
       $form->end(); 
    ?>
</div>    