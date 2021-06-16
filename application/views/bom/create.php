<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
            BOM
          <small>Tambah Data</small>
      </h1>
  </section>

  <!-- Main content -->
  <section class="content">
        <div class="row">
            <!-- left column -->
                <div class="col-md-12">
                <?php if($this->session->flashdata('error_msg')){ ?>
                      <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                        <?= $this->session->flashdata('error_msg'); ?>
                      </div>
                    <?php }else if($this->session->flashdata('succses_msg')){ ?>
                        <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                        <?= $this->session->flashdata('success_msg'); ?>
                      </div>
                    <?php } ?>
                    <!-- general form elements -->
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <a href="<?= site_url('bom') ?>" class="btn btn-success"><i class="fa fa-chevron-left"></i> Kembali</a>
                        </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <form role="form" method="POST" action="<?= site_url('bom/store')?>">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Kode BOM</label>
                                    <input type="text" class="form-control" value="<?= $kode_bom ?>" placeholder="Kode BOM" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Barang</label>
                                    <select name="barang_id" id="" class="form-control" placeholder="Barang" required>
                                        <option value="">[ -- Pilih -- ]</option>
                                        <?php
                                            foreach($dataBarang as $result) {
                                                ?>
                                                    <option value="<?= $result->id ?>"><?= $result->nama_barang ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="pull-right">
                                        <a id="b1" class="btn btn-success add-more"><span class="fa fa-plus"></span></a>
                                        <a id="b2" class="btn btn-danger add-more"><span class="fa fa-minus"></span></a>
                                    </div>
                                </div>
                                <br><br><br>
                                <div class="input-div">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Bahan Baku</label>
                                                <select name="bahan_baku_id[]" id="" class="form-control" placeholder="Bahan Baku" required>
                                                    <option value="">[ -- Pilih -- ]</option>
                                                    <?php
                                                        foreach($dataBahanBaku as $result) {
                                                            ?>
                                                                <option value="<?= $result->id ?>"><?= $result->nama_bahan_baku ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div> 
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Komposisi</label>
                                                <input type="number" step="0.01" class="form-control" name="komposisi[]" placeholder="Komposisi" required>
                                            </div>        
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Satuan</label>
                                                <input type="text" class="form-control" name="satuan[]" placeholder="Satuan" required>
                                            </div>         
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Jenis Bahan</label>
                                                <select class="form-control keterangan" name="keterangan[]">
                                                    <option value="">Pilih Jenis Bahan</option>
                                                    <option value="Bahan Baku">Bahan Baku</option>
                                                    <option value="Bahan Penolong">Bahan Penolong</option>
                                                </select>
                                            </div>         
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
