<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
            Bahan Baku
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
                            <a href="<?= site_url('bahanbaku') ?>" class="btn btn-success"><i class="fa fa-chevron-left"></i> Kembali</a>
                        </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <form role="form" method="POST" action="<?= site_url('bahanbaku/store')?>">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Kode Bahan Baku</label>
                                    <input type="text" class="form-control" placeholder="Kode Bahan Baku" value="<?= $kode_bahan_baku ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Nama Bahan Baku</label>
                                    <input type="text" class="form-control" name="nama_bahan_baku" placeholder="Nama Bahan Baku" required>
                                </div>

                                <div class="form-group">
                                    <label>Satuan</label>
                                    <input type="text" class="form-control" name="satuan" placeholder="Satuan" required>
                                </div>

                                <div class="form-group">
                                    <label>Harga Satuan</label>
                                    <input type="number" class="form-control" name="harga_satuan" placeholder="Harga Satuan" required>
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