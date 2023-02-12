<div class="container">
    <div class="row">
        <div class="col">
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
                        <button class="btn btn-danger">delete</button>
                        <button class="btn btn-warning">edit</button>
                    </td>
                </tr>    
                <?php 
                    }
                ?>
                
            </table>
        </div>

    </div>    
</div>