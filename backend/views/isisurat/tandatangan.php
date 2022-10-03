<?php

use backend\models\Asalsurat;
use backend\models\Isisurat;
use backend\models\Naskahdinas;
use backend\models\Tujuansurat;
use backend\models\User;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


foreach ($data1 as $values) :
endforeach;
foreach ($data2 as $valuess) :
endforeach;
$user = User::find()->all();


/* @var $this yii\web\View */
/* @var $model backend\models\Informasisurat */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Tanda Tangan Surat';
$this->params['breadcrumbs'][] = ['label' => 'Tembusan Surat', 'url' => ['isisurat/tembusan', 'id' => $values->id]];
$this->params['breadcrumbs'][] = $this->title;

$no = 1;
?>

<div class="informasisurat-form content">
    <div class="container-fluid">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="row ">
            <div class="col-12">
                <div class="card ">
                    <div class="card-header " style="background-color: #0093dd;">
                        <h5>
                            <nav class="navbar navbar-expand-lg   float-right">
                                <div class="bg-light">
                                    <a class="nav-item nav-link text-light" href="<?= Url::toRoute(['informasisurat/update', 'id' => $values->id_informasi]) ?>">Informasi Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                </div>
                                <div class="bg-light">
                                    <a class="nav-item nav-link text-light disabled">Tujuan Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                </div>
                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['isisurat/update', 'id' => $values->id]) ?>">Isi Surat<i class=" text-danger float-right fa fa-star-of-life danger" style=" font-size: 10px; "></i> </span></a>
                                </div>
                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['isisurat/lampiran', 'id' => $values->id]) ?>">Lampiran </span></a>
                                </div>
                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light" href="<?= Url::toRoute(['isisurat/tembusan', 'id' => $values->id]) ?>">Tembusan</span></a>
                                </div>
                                <div class="bg-light ">
                                    <a class="nav-item nav-link text-light " href="<?= Url::toRoute(['isisurat/tandatangan', 'id' => $values->id]) ?>">Verification </span></a>
                                </div>
                            </nav>
                        </h5>
                    </div>

                    <div class="card-body  ">

                        <div class="col-md-7">
                            <div class="card ">
                                <!-- /.card-header -->
                                <div class="card-body ">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr align="center">
                                                <th>No.</th>
                                                <th>Nama</th>
                                                <th>Status</th>
                                                <th>Ket</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data3 as $tandatangan) : ?>
                                                <tr align="center">
                                                    <td><?php echo $no ?></td>
                                                    <?php $user =  user::find()->where(['id' => $tandatangan['id_user']])->one(); ?>
                                                    <td><?php echo $user["username"]; ?></td>

                                                    <td>
                                                        <?php if ($tandatangan["status"] ==  "diperiksa") { ?>
                                                            <div class="bg-danger"><?php echo $tandatangan["status"]; ?></div>
                                                        <?php } else if ($tandatangan["status"] == "perbaiki") { ?>
                                                            <div class="bg-warning"><?php echo $tandatangan["status"]; ?></div>
                                                        <?php } ?>
                                                        <?php if ($tandatangan["status"] == "diterima") { ?>
                                                            <div class="bg-success"><?php echo $tandatangan["status"]; ?></div>
                                                        <?php } ?>

                                                    </td>
                                                    <td><?php echo $tandatangan["ket"]; ?></td>
                                                </tr>
                                                <?php $no++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>


</div>