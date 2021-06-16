Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
            Kebutuhan Pengadaan
          <small>Tambah Data</small>
      </h1>
  </section>

  <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <a href="<?= site_url('kebutuhan') ?>" class="btn btn-success"><i class="fa fa-chevron-left"></i> Kembali</a>
                        </div>

                        <div class="box-body">
                            <form action="<?= site_url('kebutuhan/simpanbarang') ?>" method="POST">
                                <div class="form-group">
                                    <label>Kode Pengadaan</label>
                                    <input type="text" class="form-control" placeholder="Kode Pengadaan" value="<?= $kode_pengadaan ?>" name="id" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Pengadaan</label>
                                    <input type="text" class="form-control" value="<?= date('d F Y') ?>" placeholder="Tanggal Pembelian" name="tanggal_transaksi" readonly>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Barang</label>
                                            <select name="id_barang" id="" class="form-control" required>
                                                <option value="">[ Pilih Barang ]</option>
                                                <?php
                                                    foreach($dataBarang as $barang) {
                                                        ?>
                                                            <option value="<?= $barang->id ?>"><?= $barang->id ?> - <?= $barang->nama_barang ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Jumlah Pengadaan</label>
                                            <input type="number" name="qty" class="form-control" value="" placeholder="Jumlah Pengadaan" required>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Action</label>
                                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            <!-- /.box-body -->
                            </form>
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Barang</th>
                                    <th>Jumlah Pengadaan</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $totalPembelian = 0;
                                        foreach($dataDetail as $index => $result) {
                                            ?>
                                                <tr>
                                                    <td><?= $index + 1; ?></td>
                                                    <td><?= $result->id_barang; ?></td>
                                                    <td><?= $result->nama_barang; ?></td>
                                                    <td><?= $result->qty; ?></td>
                                                    <td>
                                                        <a href="<?= site_url('kebutuhan/deleteitem/'.$result->id_transaksi.'/'.$result->id_barang) ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php
                                            // $totalPembelian += $result->sub_total;
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <br>
                            <br>
                           <!--  <form action="<?= site_url('kebutuhan/pembelianselesai') ?>" method="POST">
							    <input type="hidden" class="form-control" name="id"  value="<?= $kode_pengadaan ?>"> -->
                               <!--  <div class="form-group">
                                    <label>Total Transaksi</label>
                                    <input type="text" class="form-control" placeholder="Total Transaksi" value="Rp. <?= number_format($totalPembelian, 0, ",", ".") ?>" readonly>
                                </div> -->

                                <!-- <div class="form-group">
                                    <label>Pemasok</label>
                                    <select name="pemasok_id" id="" class="form-control" required>
                                        <option value="">[ Pilih Pemasok ]</option>
                                        <?php
                                            foreach($dataPemasok as $pemasok) {
                                                ?>
                                                    <option value="<?= $pemasok->id ?>"><?= $pemasok->id ?> - <?= $pemasok->nama ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div> -->

                                <!-- <div class="form-group"> -->
                            <a href="<?= site_url('kebutuhan/hitungKebutuhan/'.$kode_pengadaan.'') ?>" class="btn btn-primary">Hitung Kebutuhan Bahan Baku <i class="fa fa-chevron-right"></i></a>
                                    <!-- <button class="btn btn-primary" type="submit"> Hitung Kebutuhan Bahan Baku</button> -->
                                <!-- </div> -->
                            <!-- /.box-body -->
                            <!-- </form> -->
                        </div>
                      
                    </div>
                </div>
            <!-- /.box -->
            </div>
            <!--/.col (left) -->
        </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
  <!-- /.content-wrapper