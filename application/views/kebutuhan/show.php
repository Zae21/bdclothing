<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Detail Kebutuhan Pengadaan
            <small>data</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    <?php
                        if ($this->uri->segment('2')=='show') {?>
                           
                        <a href="<?= site_url('kebutuhan') ?>" class="btn btn-danger"><i class="fa fa-chevron-left"></i> Kembali</a>
                    <?php    }else{
                    ?>
                        <a href="<?= site_url('kebutuhan/create') ?>" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Edit Data Pengadaan</a>
                    <?php } ?>
                    </div>  
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table">
                            <tr>
                                <th width="250px">Kode Pengadaan</th>
                                <td width="50px">:</td>
                                <td><?= $pengadaan->id_transaksi ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Penjualan</th>
                                <td>:</td>
                                <td><?= date('d F Y', strtotime($pengadaan->tanggal_transaksi)) ?></td>
                            </tr>
                        </table>
                        <br>
                        <br>
                        <div class="box-title">
                            <h3>Detail Barang Yang Diadakan</h3>
                        </div>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Barang</th>
                                    <th>Jumlah Pengadaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($dataDetail as $index => $result) {
                                        ?>
                                            <tr>
                                                <td><?= $index + 1; ?></td>
                                                <td><?= $result->id_barang; ?></td>
                                                <td><?= $result->nama_barang; ?></td>
                                                <td><?= $result->qty; ?></td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                        <div class="box-title">
                            <h3>Detail Kebutuhan Bahan Baku Untuk Pengadaan</h3>
                        </div>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Bahan Baku</th>
                                    <th>Bahan Baku</th>
                                    <th>Jumlah Pengadaan</th>
                                    <th>Satuan</th>
                                    <th>Harga Satuan</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($dataKebutuhan as $index => $result) {
                                        $jumlah =$result->qty*$result->komposisi;
                                        ?>
                                            <tr>
                                                <td><?= $index + 1; ?></td>
                                                <td><?= $result->bahan_baku_id; ?></td>
                                                <td><?= $result->nama_bahan_baku; ?></td>
                                                <td><?= $jumlah; ?></td>
                                                <td><?= $result->satuan; ?></td>
                                                <td><?= "Rp. ".number_format($result->harga_satuan); ?></td>
                                                <td><?= "Rp. ".number_format($jumlah*$result->harga_satuan); ?></td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br>

                    <?php
                        if ($this->uri->segment('2')=='hitungKebutuhan') {?>
                     <a href="<?= site_url('kebutuhan/generatePembelian/'.$pengadaan->id_transaksi.'') ?>" class="btn btn-primary">Simpan <i class="fa fa-chevron-right"></i></a>
                    <?php }?>
                    </div>
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