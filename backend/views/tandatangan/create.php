<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Tandatangan */

$this->title = 'Create Tandatangan';
$this->params['breadcrumbs'][] = ['label' => 'Tandatangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tandatangan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
