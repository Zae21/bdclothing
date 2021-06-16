Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pembayaran Beban
            <small>data</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="<?= site_url('pembayaran/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                    </div>  
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Kode Transaksi</th>
                                  <th>Tanggal</th>
                                  <th>Keterangan</th>
                                  <th>Total</th>
                                  <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($dataPembayaran as $index => $result) {
                                        ?>
                                            <tr>
                                                <td><?= $index + 1; ?></td>
                                                <td><?= $result->id_pembayaran; ?></td>
                                                <td><?= date("d F Y", strtotime($result->tgl_transaksi)); ?></td>
                                                <td>Pembayaran <?= $result->nama_kategori; ?></td>
                                                <td><?= "Rp. ".number_format($result->total_transaksi, 0, ",", "."); ?></td>
                                                <!-- <td>
                                                    <a href="<?= site_url('penjualan/show/'.$result->id_pembayaran) ?>" class="btn btn-info btn-sm"><i class="fa fa-th"></i></a>
                                                </td> -->
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
<!-- /.content-wrapper