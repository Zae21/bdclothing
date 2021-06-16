<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
            Barang
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
                            <a href="<?= site_url('barang') ?>" class="btn btn-success"><i class="fa fa-chevron-left"></i> Kembali</a>
                        </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <form role="form" method="POST" action="<?= site_url('barang/store')?>" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Kode Barang</label>
                                    <input type="text" class="form-control" placeholder="Kode Barang" value="<?= $kode_barang ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang" required>
                                    <?=form_error('nama_barang')?>
                                </div>

                                <div class="form-group">
                                    <label>Kategori Barang</label>
                                    <select name="kategori_barang_id" id="" class="form-control" placeholder="Kategori Barang" required>
                                        <option value="">[ -- Pilih -- ]</option>
                                        <?php
                                            foreach($dataKategoriBarang as $result) {
                                                ?>
                                                    <option value="<?= $result->id ?>"><?= $result->nama ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                    <?=form_error('kategori_barang_id')?>
                                </div>

                                <div class="form-group">
                                    <label>Harga Jual Satuan</label>
                                    <input type="number" class="form-control" name="harga_jual_satuan" placeholder="Harga Jual Satuan" required>
                                    <?=form_error('harga_jual_satuan')?>
                                </div>

                                <div class="form-group">
                                    <label>Harga Produk Satuan</label>
                                    <input type="number" class="form-control" name="harga_produk_satuan" placeholder="Harga Produk Satuan" required>
                                    <?=form_error('harga_produk_satuan')?>
                                </div>

                                <div class="form-group">
                                  <label for="gambar">Gambar</label>
                                  <input type="file" class="form-control-file" name="gambar">
                                </div> 

                                <div class="form-group">
                                  <label for="gambar">Status Produk</label>
                                  <select name="is_popular" id="" class="form-control" placeholder="Status Produk" required>
                                        <option value="">[ -- Pilih -- ]</option>
                                        <option value="1">Populer Produk</option>
                                        <option value="2">Produk In Stok</option>
                                        <option value="3">New In Stok</option>
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