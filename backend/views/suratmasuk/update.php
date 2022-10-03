<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Suratmasuk */

$this->title = 'Update Suratmasuk ' ;
$this->params['breadcrumbs'][] = ['label' => 'Suratmasuks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_sm, 'url' => ['view', 'id_sm' => $model->id_sm]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="suratmasuk-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
