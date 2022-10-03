<?php

use backend\models\Asalsurat;
use backend\models\Jabatan;
use backend\models\Role;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Suratmasuk */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Pembuatan User';
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="suratmasuk-form">

    <div class="container-fluid">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="row ">
            <div class="col-12">
                <div class="card ">
                    <div class="card-header" style="background-color: #0093dd;">
                        <h4 class="card-title">
                            <?= Html::encode($this->title) ?>
                        </h4>
                    </div>

                    <div class="card-body ">

                        <div class="row">
                            <div class="col-md-4">

                                <?= $form->field($model, 'foto')->fileInput(['maxlength' => true])->label("Upload Foto") ?>
                            </div>
                        </div>


                        <span>

                            <?= Html::submitButton('<span class="fa fa-check"></span>', ['class' => 'btn btn-success', 'title' => 'save']) ?>
                        </span>
                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>