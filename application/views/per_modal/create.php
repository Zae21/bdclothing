<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
            Perubahan Modal
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
                            <a href="<?= site_url('pemb_modal') ?>" class="btn btn-success"><i class="fa fa-chevron-left"></i> Kembali</a>
                        </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <form role="form" method="POST" action="<?= site_url('pemb_modal/store')?>">
                            <div class="box-body">
                                <div class="form-group">
                                        <label>No. Transaksi</label>
                                        <input type="text" class="form-control" name="id_modal" placeholder="No. Pembayaran" value="<?= $kode_modal ?>" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Tanggal Transaksi</label>
                                        <input type="text" class="form-control" value="<?= date('d F Y') ?>" placeholder="Tanggal Penjualan" name="tgl_transaksi" readonly>
                                    </div>

                                  <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Kategori Perubahan Modal</label>
                                            <select name="keterangan" class="form-control">
                                              <option> [Pilih Kategori Perubahan Modal] </option>
                                              <option value="Penambahan Modal"> Penambahan Modal </option>
                                              <option value="Penarikan Modal Untuk Kepentingan Pribadi"> Penarikan Modal Untuk Kepentingan Pribadi </option>
                                            </select>
                                          </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Total Transaksi</label>
                                            <input type="number" name="total_transaksi" class="form-control" value="" placeholder="Total Transaksi" required>
                                        </div>
                                    </div>                                    
                                </div>

                                </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            <!-- /.box -->
            </div>
            <!--/.col (left) -->
        </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
  <!-- /.content-wrapper -->
  <datalist id="beban">
        <?php
           foreach($dataKategori as $d) { ?>
            <option value="<?= $d->id ?>"><?= $d->nama_kategori ?></option>
        <?php } ?>
    </datalist>