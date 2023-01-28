<?php

use yii\helpers\Html;
use aryelds\sweetalert\SweetAlert;
/** @var yii\web\View $this */
/** @var common\models\Tenant $model */

$this->title = 'Update Tenant: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tenants', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tenant-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
