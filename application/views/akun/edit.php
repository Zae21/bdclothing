<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
            Akun
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
                            <a href="<?= site_url('akun') ?>" class="btn btn-success"><i class="fa fa-chevron-left"></i> Kembali</a>
                        </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="<?= site_url('akun/update/'.$akun->kode_akun)?>">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Kode Akun</label>
                                <input type="text" class="form-control" placeholder="Kode Akun" readonly value="<?= $akun->kode_akun ?>">
                            </div>
                            
                            <div class="form-group">
                                <label>Nama Akun</label>
                                <input type="text" class="form-control" name="nama_akun" placeholder="Nama Akun" required value="<?= $akun->nama_akun ?>">
                            </div>

                            <div class="form-group">
                                <label>Header Akun</label>
                                <select name="header_akun" id="" class="form-control">
                                    <option value="">[ Pilih Header Akun ]</option>
                                    <?php
                                        foreach($dataAkun as $akun) {
                                            ?>
                                                <option value="<?= $akun->kode_akun ?>"><?= $akun->kode_akun ?> - <?= $akun->nama_akun ?></option>
                                            <?php
                                        }
                                    ?>
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