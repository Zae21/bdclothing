<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
            Barang
            <small>Edit Data</small>
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
                        <form role="form" method="POST" action="<?= site_url('barang/update/'.$barang->id)?>" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Kode Barang</label>
                                    <input type="text" class="form-control" placeholder="Kode Barang" value="<?= $barang->id ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang" required value="<?= $barang->nama_barang ?>">
                                </div>

                                <div class="form-group">
                                    <label>Kategori Barang</label>
                                    <select name="kategori_barang_id" id="" class="form-control" placeholder="Kategori Barang" required>
                                        <option value="">[ -- Pilih -- ]</option>
                                        <?php
                                            foreach($dataKategoriBarang as $result) {
                                                ?>
                                                    <option value="<?= $result->id ?>" <?= $result->id == $barang->kategori_barang_id ? "selected" : "" ?>><?= $result->nama ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Harga Jual Satuan</label>
                                    <input type="number" class="form-control" name="harga_jual_satuan" placeholder="Harga Jual Satuan" required value="<?= $barang->harga_jual_satuan ?>">
                                </div>

                                <div class="form-group">
                                    <label>Harga Produk Satuan</label>
                                    <input type="number" class="form-control" name="harga_produk_satuan" placeholder="Harga Produk Satuan" required value="<?= $barang->harga_produk_satuan ?>">
                                </div>

                                <div class="form-group">
                                  <label for="gambar">Gambar</label>
                                  <input type="file" class="form-control-file" name="gambar">
                                  <input type="hidden" name="old_image" value="<?php echo $barang->gambar; ?>" />
                                </div> 
                                <div class="form-group">
                                  <label for="gambar">Status Produk</label>
                                  <select name="is_popular" id="" class="form-control" placeholder="Status Produk" required>
                                        <option value="">[ -- Pilih -- ]</option>
                                        <option value="1" <?= $barang->is_popular == 1 ? "selected" : "" ?>>Populer Produk</option>
                                        <option value="2" <?= $barang->is_popular == 2 ? "selected" : "" ?>>Produk In Stok</option>
                                        <option value="3" <?= $barang->is_popular == 3 ? "selected" : "" ?>>New In Stok</option>
                                    </select>
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