<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Tandatangan */

?>
<div class="tandatangan-update">



    <?= $this->render('_form', [
        'model' => $model,
        'model2' => $model2,
        'datainformasi' => $datainformasi,
        'isi' => $isi,

    ]) ?>

</div>
