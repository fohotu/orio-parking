<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Tenant $model */

$this->title = 'Create Tenant';
$this->params['breadcrumbs'][] = ['label' => 'Tenants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tenant-create">

    <?= $this->render('_create_form', [
        'model' => $model,
    ]) ?>

</div>
