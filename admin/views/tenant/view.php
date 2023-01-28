<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap5\Tabs;


/** @var yii\web\View $this */
/** @var common\models\Tenant $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tenants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tenant-view">
<?php 
/*
echo Tabs::widget([
      'items' => [
          [
              'label' => 'Организация',
              'content' => $this->render('_organization',['model'=>$model]),
              'active' => true
          ],
          [
              'label' => 'Сотрудники',
              'content' => $this->render('_employee',['employee'=>$employee]),
          ],
 
       
      ],
  ]);
*/
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
 
</div>
