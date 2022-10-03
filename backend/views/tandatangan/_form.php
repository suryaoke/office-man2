<?php

use backend\models\Informasisurat;
use backend\models\Isisurat;
use backend\models\Log;
use common\models\User;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = 'Tandatangan Surat';
$this->params['breadcrumbs'][] = $this->title;
$no = 1;
?>

<div class="content">
    <?php $form = ActiveForm::begin(); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card o">
                    <div class="card-header" style="background-color: #0093dd;">
                        <h3 class="card-title">Tandatangan Surat </h3>
                    </div>
                    <div class="card-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr align="center">
                                    <th>Tujuan Surat</th>
                                    <th>Perihal</th>
                                    <th>Nomor <br> Agenda Surat</th>
                                    <th>Tanggal <br> Surat</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($datainformasi as $informasi) : ?>
                                    <tr align="center">
                                        <td><?php echo $informasi['tujuan_surat'] ?></td>
                                        <td><?php echo $informasi['perihal'] ?></td>
                                        <td><?php echo $informasi['nomor_agenda'] ?></td>
                                        <td><?php echo $informasi['tanggal_surat'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                        </table>

                        <table id="example2" class="table table-bordered table-hover">
                            <thead align="center">

                            </thead>
                            <tbody align="center">
                                <td> <?= $form->field($isi, 'isi')->textarea(['rows' => 6, 'id' => 'content2', 'value' => $isi->isi])->label(false) ?></td>
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-md-10">
                                <br>
                            </div>


                        </div>
                        <div class="row ">

                            <div class="col-md-9">
                                <?php if ($model->status == "diperiksa") { ?>
                                    <button type="button" class="btn btn-warning " data-toggle="modal" data-target="#exampleModalCenter">
                                        Perbaiki
                                    </button>
                                <?php } ?>
                            </div>
                            <?= Html::a('Detail Surat', ['informasisurat/update', 'id' => $informasi->id], ['class' => 'btn ', 'style' => "background-color: #0093dd;"]) ?>

                            <?php if ($model->status == "ditandatangan") { ?>
                                <div>&nbsp;&nbsp;&nbsp;</div>
                                <?= Html::a('Kirim Surat ', ['kirim', 'id' => $model->id], ['class' => 'btn btn-success']) ?>

                            <?php } ?>
                            <div>&nbsp;&nbsp;&nbsp;</div>
                            <?php if ($model->status == "diperiksa") { ?>
                                <button type="button" class="btn btn-success " data-toggle="modal" data-target="#exampleModalCenterr">
                                    Tandatangan
                                </button>



                            <?php } ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



<!-- Modal Perbaiki-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Keterangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $form->field($model, 'ket')->textarea(['rows' => 6, 'maxlength' => true])->label(false) ?>
                <?= $form->field($model, 'status')->hiddenInput(['maxlength' => true, 'value' => "perbaiki"])->label(false) ?>
                <?= $form->field($model2, 'status')->hiddenInput(['maxlength' => true, 'value' => "perbaiki"])->label(false) ?>
                <?php $log = new Log();
                $log->id_user =  Yii::$app->user->identity->id;
                $log->perihal = "Perbaiki Surat Baru";
                $log->date = Date("d-m-Y ");
                $log->save(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>


<!-- // Modal Tandatangan // -->
<div class="modal fade bd-example-modal-xl" id="exampleModalCenterr" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tanda Tangan </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table border="1" align="center">
                    <tr>
                        <td>
                            <div id="signature">

                            </div>
                        </td>
                    </tr>
                </table>

                <br />

                <!-- <input type='button' id='click' value='click'> -->
                <form enctype="multipart/form-data" method="POST" action="<?= Url::toRoute(['/tandatangan/acc-ttd?id=' . $model->id]) ?>" class="form-horizontal" onsubmit="return confirm('Yakin tidak ada perubahan pada tanda tangan anda ?')">
                    <textarea id='output' name="img" style="display:none;"></textarea><br />
                    <img src='' id='sign_prev' style='display: none;' />
                    <br>
                    <br>
                    <div id="tombol-cek" style="display: block;">
                        <input type="button" class="btn btn-primary" id="click" value="Cek">
                    </div>
                    <div id="tombol-simpan" style="display: none;">
                        <input type="submit" class="btn btn-primary" id="click-simpan" value="Simpan Tanda Tangan">
                    </div>



                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>