<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pengadaan
            <small>data</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="<?= site_url('kebutuhan/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                    </div>  
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Kode Pengadaan</th>
                                  <th>Tanggal</th>
                                  <th>Status</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($dataPengadaan as $index => $result) {
                                        ?>
                                            <tr>
                                                <td><?= $index + 1; ?></td>
                                                <td><?= $result->id_transaksi; ?></td>
                                                <td><?= date("d F Y", strtotime($result->tanggal_transaksi)); ?></td>
                                                <td>
                                                    <?php
                                                        if($result->status == 1) {
                                                            ?><label for="" class="label label-info">Dalam Proses Pengadaan Bahan Baku</label><?php
                                                        } else if($result->status == 2) {
                                                            ?><label for="" class="label label-warning">Dalam Proses Pembelian Bahan Baku</label><?php
                                                        } else {
                                                            ?><label for="" class="label label-success">Selesai</label><?php
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="<?= site_url('kebutuhan/show/'.$result->id_transaksi) ?>" class="btn btn-info btn-sm"><i class="fa fa-th"></i></a>
                                                    <?php
                                                        if($result->status < 3) {
                                                            ?>
                                                                <a href="<?= site_url('kebutuhan/updatestatus/'.$result->id_transaksi) ?>" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
                                                            <?php
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->