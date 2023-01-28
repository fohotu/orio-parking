<?php 
use yii\helpers\Html;
use yii\widgets\DetailView;
?>
<div class='tab_content'>
    <div class='tab_button'>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

    </div>    
        

<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tenant_name',
            'tin',
            'bic',
            'checking_account',
            'address:ntext',
            'bank_name:ntext',
            'cost_per_hour:ntext',
            'allocated_spaces_count',
            'created_at',
            'updated_at',
            'created_by',
        ],
    ]) ?>

</div>    