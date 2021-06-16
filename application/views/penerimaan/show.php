<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Detail Penerimaan
            <small>data</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="<?= site_url('penerimaan') ?>" class="btn btn-success"><i class="fa fa-chevron-left"></i> Kembali</a>
                    </div>  
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table">
                            <tr>
                                <th width="250px">Kode Penerimaan</th>
                                <td width="50px">:</td>
                                <td><?= $penerimaan->id_penerimaan ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Penerimaan</th>
                                <td>:</td>
                                <td><?= date('d F Y', strtotime($penerimaan->tanggal_transaksi)) ?></td>
                            </tr>
                            <tr>
                                <th>Total Pembelian</th>
                                <td>:</td>
                                <td>Rp. <?= number_format($penerimaan->total, 0, ",", ".") ?></td>
                            </tr>
                        </table>
                        <br>
                        <br>
                        <div class="box-title">
                            <h3>Detail Pembelian</h3>
                        </div>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Jumlah</th>
                                    <th>Total Biaya Bahan Baku</th>
                                    <th>Total Biaya Produksi</th>
                                    <th>Total Biaya Lainnya</th>
                                    <th>Sub Total</th>
                                    <th>Total Biaya Per 1 Barang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subtotal = 0;
                                    $total = 0;
                                    foreach($dataDetail as $index => $result) {
                                        $subtotal = $result->biaya_bahan_baku+$result->biaya_produksi+$result->biaya_tambahan;
                                        $total = $total+$subtotal;
                                        $biaya = $subtotal/$result->qty;
                                        ?>
                                            <tr>
                                                <td><?= $index + 1; ?></td>
                                                <td><?= $result->id_barang; ?></td>
                                                <td><?= $result->qty; ?></td>
                                                <td><?= "Rp. ".number_format($result->biaya_bahan_baku, 0, ",", "."); ?></td>
                                                <td><?= "Rp. ".number_format($result->biaya_produksi, 0, ",", "."); ?></td>
                                                <td><?= "Rp. ".number_format($result->biaya_tambahan, 0, ",", ".") ?></td>
                                                <td><?= "Rp. ".number_format($subtotal, 0, ",", ".") ?></td>
                                                <td><?= "Rp. ".number_format($biaya, 0, ",", ".") ?></td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                                <tr>
                                    <td colspan="6"><b>Total Transaksi</b></td>
                                    <td colspan="2"><b><?= "Rp. ".number_format($total, 0, ",", ".") ?></b></td>
                                </tr>
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