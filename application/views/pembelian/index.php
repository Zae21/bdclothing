<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pembelian
            <small>data</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="<?= site_url('pembelian/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                    </div>  
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Kode Pembelian</th>
                                  <th>Tanggal</th>
                                  <th>Nama Pemasok</th>
                                  <th>Total</th>
                                  <th>Status</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($dataPembelian as $index => $result) {
                                        ?>
                                            <tr>
                                                <td><?= $index + 1; ?></td>
                                                <td><?= $result->id; ?></td>
                                                <td><?= date("d F Y", strtotime($result->tanggal_transaksi)); ?></td>
                                                <td><?= $result->nama; ?></td>
                                                <td><?= "Rp. ".number_format($result->total_transaksi, 0, ",", "."); ?></td>
                                                <td>
                                                    <?php
                                                        if($result->status == 2) {
                                                            ?><label for="" class="label label-warning">Dalam Proses</label><?php
                                                        } else if($result->status == 3) {
                                                            ?><label for="" class="label label-warning">Dalam Proses</label><?php
                                                        } else {
                                                            ?><label for="" class="label label-success">Selesai</label><?php
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="<?= site_url('pembelian/show/'.$result->id) ?>" class="btn btn-info btn-sm"><i class="fa fa-th"></i></a>
                                                    <?php
                                                        if($result->status != 4) {
                                                            ?>
                                                                <a href="<?= site_url('pembelian/updatestatus/'.$result->id) ?>" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
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