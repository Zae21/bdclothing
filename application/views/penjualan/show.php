<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Detail Penjualan
            <small>data</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="<?= site_url('penjualan') ?>" class="btn btn-success"><i class="fa fa-chevron-left"></i> Kembali</a>
                    </div>  
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table">
                            <tr>
                                <th width="250px">Kode Penjualan</th>
                                <td width="50px">:</td>
                                <td><?= $penjualan->id ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Penjualan</th>
                                <td>:</td>
                                <td><?= date('d F Y', strtotime($penjualan->tanggal_transaksi)) ?></td>
                            </tr>
                            <tr>
                                <th>Total Penjualan</th>
                                <td>:</td>
                                <td>Rp. <?= number_format($penjualan->total_transaksi, 0, ",", ".") ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>:</td>
                                <td>
                                    <?php
                                        if($penjualan->status == 2) {
                                            ?><label for="" class="label label-warning">Dalam Proses</label><?php
                                        } else if($penjualan->status == 3) {
                                            ?><label for="" class="label label-warning">Dalam Proses</label><?php
                                        } else {
                                            ?><label for="" class="label label-success">Selesai</label><?php
                                        }
                                    ?>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <br>
                        <div class="box-title">
                            <h3>Detail Penjualan</h3>
                        </div>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Bahan Baku</th>
                                    <th>Bahan Baku</th>
                                    <th>Harga Satuan</th>
                                    <th>Jumlah Penjualan</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($dataDetail as $index => $result) {
                                        ?>
                                            <tr>
                                                <td><?= $index + 1; ?></td>
                                                <td><?= $result->barang_id; ?></td>
                                                <td><?= $result->nama_barang; ?></td>
                                                <td><?= "Rp. ".number_format($result->harga_satuan, 0, ",", "."); ?></td>
                                                <td><?= $result->jumlah_penjualan; ?></td>
                                                <td><?= "Rp. ".number_format($result->sub_total, 0, ",", ".") ?></td>
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