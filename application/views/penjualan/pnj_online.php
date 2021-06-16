<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Penjualan Online
            <small>data</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <!-- <a href="<?= site_url('penjualan/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a> -->
                    </div>  
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                  <th>No</th>
                                  <th>ID penjualan</th>
                                  <th>Tanggal</th>
                                  <th>Nama Pelanggan</th>
                                  <th>Alamat Pengiriman</th>
                                  <th>Jenis Expedisi</th>
                                  <th>Ongkir</th>
                                  <th>Total</th>
                                  <th>Status</th>
                                  <th>Bukti Bayar</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($dataPenjualan as $index => $result) {
                                        ?>
                                            <tr>
                                                <td><?= $index + 1; ?></td>
                                                <td><?= $result->id_transaksi; ?></td>
                                                <td><?= date("d F Y", strtotime($result->tanggal_transaksi)); ?></td>
                                                <td><?= $result->nama; ?></td>
                                                <td><?= $result->kota; ?></td>
                                                <td><?= $result->jenis_ekspedisi; ?></td>
                                                <td><?= "Rp. ".number_format($result->ongkir, 0, ",", "."); ?></td>
                                                <td><?= "Rp. ".number_format($result->total_transaksi, 0, ",", "."); ?></td>
                                                <td>
                                                    <?php
                                                        if($result->status == 2) {
                                                            ?><label for="" class="label label-danger">Belum Bayar</label><?php
                                                        } else if($result->status == 3) {
                                                            ?><label for="" class="label label-warning">Proses Packing</label><?php
                                                        } else if($result->status == 4){
                                                            ?><label for="" class="label label-success">Dalam Pengiriman</label><?php
                                                        } else{
                                                            ?><label for="" class="label label-primary">Selesai</label><?php
                                                        }
                                                    ?>
                                                </td>
                                                <td></td>
                                                <td>
                                                    <!-- <a href="<?= site_url('penjualan/show/'.$result->id_transaksi) ?>" class="btn btn-info btn-sm"><i class="fa fa-th"></i></a> -->
                                                    <?php
                                                        if($result->status != 4) {
                                                            ?>
                                                                <a href="<?= site_url('penjualan/updatestatus/'.$result->id) ?>" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
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