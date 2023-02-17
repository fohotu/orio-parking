<?php 
use yii\helpers\Url;
?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <a href="#" class="btn btn-success">Create</a>
            <table class="table table-bordered">

                <?php 
                    foreach($model as $item){
                ?>
                <tr>
                    <td>
                        <?php echo $item->name;?>
                    </td>
                    <td>
                        <?php echo $item->description;?>
                    </td>
                    <td>
                        <a href="<?php echo Url::to(['edit','role'=>$item->name]);?>" class="btn btn-warning">edit</a>
                        <a href="<?php echo Url::to(['delete','role'=>$item->name]);?>"  data-method='post' data-confirm="Are you sure to delete this 1" class='btn btn-success'>Удалить</a>
  
                    </td>
                </tr>    
                <?php 
                    }
                ?>
                
            </table>
        </div>

    </div>    
</div>