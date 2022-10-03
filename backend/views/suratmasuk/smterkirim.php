<?php

use backend\models\Smpenerima;
use backend\models\Suratmasuk;
use backend\models\User;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\AsalsuratSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'MAN2 | Surat Masuk Terkirim';
$this->params['breadcrumbs'][] = $this->title;
$no = 1;
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>dist/css/adminlte.min.css">
</head>
<div class="smterkirim-index content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card ">
                    <div class="card-header" style="background-color: #0093dd;">
                        <h4 class="card-title">
                            <?= Html::encode($this->title) ?>
                        </h4>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body ">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr align="center">
                                    <th>No.</th>
                                    <th>Tanggal <br> Surat</th>
                                    <th>Nomor <br> Agenda Surat</th>
                                    <th>Perihal</th>
                                    <th>Asal Surat</th>
                                    <th>Tujuan</th>
                                    <th>Status</th>
                                    <th>Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($smterkirim as $value) : ?>
                                    <tr align="center">
                                        <td><?php echo $no; ?></td>
                                        <td><?php $suratmasuk = Suratmasuk::find()->where(['id_sm' => $value["id_sm"]])->one();
                                            echo $suratmasuk['tanggal_surat']; ?></td>
                                        <td>
                                            <?php $suratmasuk = Suratmasuk::find()->where(['id_sm' => $value["id_sm"]])->one();
                                            echo $suratmasuk['no_surat']; ?>
                                        </td>
                                        <td>
                                            <?php $suratmasuk = Suratmasuk::find()->where(['id_sm' => $value["id_sm"]])->one();
                                            echo $suratmasuk['perihal']; ?>
                                        </td>
                                        <td>
                                            <?php $suratmasuk = Suratmasuk::find()->where(['id_sm' => $value["id_sm"]])->one();
                                            echo $suratmasuk['asal_surat']; ?>
                                        </td>
                                        <td>
                                            <?php $suratmasuk = Suratmasuk::find()->where(['id_sm' => $value["id_sm"]])->one();
                                            $user = User::find()->where(['id' => $suratmasuk["tujuan"]])->one();
                                            echo $user['nama'];  ?>
                                        </td>
                                        <td>
                                            <?php
                                            $suratmasuk = Smpenerima::find()->where(['id_sm' => $value["id_sm"]])->one();
                                            ?>
                                            <?php if ($suratmasuk["status"] ==  "belum dibaca") { ?>
                                                <div class="bg-danger"><?php echo $suratmasuk["status"]; ?></div>
                                            <?php } else if ($suratmasuk["status"] == "dibaca") { ?>
                                                <div class="bg-warning"><?php echo $suratmasuk["status"]; ?></div>
                                            <?php } ?>
                                        </td>
                                        <td align="right">

                                            <?= Html::a('<span class="fa fa-book"></span>', ['terkirimdisposisi', 'id_sm' => $value->id_sm], ['class' => 'btn btn-success', 'title' => 'Disposisi']) ?>

                                            <?php $a = Smpenerima::find()->where(['id_sm' => $value["id_sm"]])->one(); ?>
                                            <?php if ($a["status"] == "belum dibaca" || Yii::$app->user->identity->role ==  "admin") { ?>

                                                <?= Html::a('<span class="fa fa-trash"></span>', ['delete', 'id_sm' => $value->id_sm], [
                                                    'class' => 'btn btn-danger',
                                                    'title' => 'delete',
                                                    'data' => [
                                                        'confirm' => 'Are you sure you want to delete this item?',
                                                        'method' => 'post',
                                                    ],
                                                ]) ?>
                                            <?php } ?>
                                        </td>

                                    </tr>
                                    <?php $no++; ?>
                                <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->


            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/jszip/jszip.min.js"></script>
        <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/pdfmake/pdfmake.min.js"></script>
        <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/pdfmake/vfs_fonts.js"></script>
        <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?= Yii::$app->getHomeUrl(); ?>dist/js/adminlte.min.js"></script>

        <!-- Page specific script -->
        <!-- jQuery -->
        <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/jquery-ui/jquery-ui.min.js"></script>

        <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
        <script>
            $(document).ready(function() {
                $('#example1').DataTable();
            });
        </script>




        </html>

    </div>
</div>