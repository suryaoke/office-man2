<?php

use backend\models\Informasisurat;
use backend\models\Notif1;
use backend\models\Role;
use backend\models\Smdisposisi;
use backend\models\Smpenerima;
use backend\models\Suratmasuk;
use common\models\User;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = 'Surat baru';
$this->params['breadcrumbs'][] = $this->title;
$no = 1;
foreach ($ket  as $value) :


endforeach; 
$user =  User::find()->all();
?>

<div class="content">
    <?php $form = ActiveForm::begin(); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card o">
                    <div class="card-header" style="background-color: #0093dd;">
                        <h3 class="card-title">Surat Baru</h3>
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
                                <?php foreach ($isi  as $value) : ?>
                                    <?php $tanggal = Informasisurat::find()->where(['id' => $value['id_informasi']])->one(); ?>
                                    <tr align="center">
                                        <td><?php echo $tanggal["tujuan_surat"]; ?></td>
                                        <td><?php echo $tanggal["perihal"]; ?></td>
                                        <td><?php echo $tanggal["nomor_agenda"]; ?></td>

                                        <td><?php echo $tanggal["tanggal_surat"]; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                        </table>
                        <?php $form = ActiveForm::begin(); ?>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead align="center">
                                <?php foreach ($isi as $data) : ?>

                            </thead>
                            <tbody align="center">
                                <td> <?= $form->field($model, 'ket')->textarea(['rows' => 6, 'id' => 'content1', 'value' => $data->isi])->label(false) ?></td>

                            <?php endforeach; ?>

                            </tbody>
                            <?php ActiveForm::end(); ?>
                        </table>
                        <?php $form = ActiveForm::begin(); ?>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            Perbaiki
                        </button>

                        <!-- Modal -->
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
                                       
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>



            </div>
        </div>
    </div>


</div>
<?php ActiveForm::end(); ?>



<script>
    $(document).ready(function() {
        // var wrapper = document.getElementById("signature");
        // var canvas = wrapper.querySelector("canvas");

        // var parentWidth = $(canvas).parent().outerWidth();
        // Initialize jSignature
        var $sigdiv = $("#signature").jSignature({
            'UndoButton': true,
            lineWidth: 5,
            // width: 500,
            // width: "ratio",
            autoFit: true,
            height: 102,
        });

        $('#click').click(function() {
            // Get response of type image
            var data = $sigdiv.jSignature('getData', 'image');

            // Storing in textarea
            $('#output').val(data);

            // ketika button cek
            $('#tombol-simpan').show();
            $('#tombol-cek').hide();
            // menampilkan data image 
            $('#sign_prev').attr('src', "data:" + data);
            $('#sign_prev').show();
        });

        $("#signature").bind('change', function(e) {
            $('#tombol-simpan').hide();
            $('#tombol-cek').show();
        });




    });
</script>