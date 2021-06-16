<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
          Kategori Barang
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
                            <a href="<?= site_url('kategoribarang') ?>" class="btn btn-success"><i class="fa fa-chevron-left"></i> Kembali</a>
                        </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <form role="form" method="POST" action="<?= site_url('kategoribarang/store')?>" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Kode Kategori Barang</label>
                                    <input type="text" class="form-control" placeholder="Kode Kategori Barang" value="<?= $kode_kategori_barang ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nama Kategori Barang</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Nama Kategori Barang" required>
                                </div>                                                      
                                <div class="form-group">
                                  <label for="gambar">Gambar</label>
                                  <input type="file" class="form-control-file" name="gambar">
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