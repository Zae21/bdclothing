<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
            BOM
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
                            <a href="<?= site_url('bom') ?>" class="btn btn-success"><i class="fa fa-chevron-left"></i> Kembali</a>
                        </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                        <form role="form" method="POST" action="<?= site_url('bom/update/'.$bom->id)?>" id="form-submit">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Kode BOM</label>
                                    <input type="text" class="form-control" value="<?= $bom->id ?>" placeholder="Kode BOM" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Barang</label>
                                    <input type="text" class="form-control" value="<?= $bom->nama_barang ?>" placeholder="Barang" readonly>
                                </div>
                                <div class="form-group">
                                    <div class="pull-right">
                                        <a id="b1" class="btn btn-success add-more"><span class="fa fa-plus"></span></a>
                                        <a id="b2" class="btn btn-danger add-more"><span class="fa fa-minus"></span></a>
                                    </div>
                                </div>
                                <br><br><br>
                                <?php
                                    foreach($dataDetailBom as $bom) {
                                        ?>
                                            <div class="input-div">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Bahan Baku</label>
                                                            <select name="bahan_baku_id[]" class="form-control" placeholder="Bahan Baku" required>
                                                                <option value="">[ -- Pilih -- ]</option>
                                                                <?php
                                                                    foreach($dataBahanBaku as $result) {
                                                                        ?>
                                                                            <option value="<?= $result->id ?>" <?= $bom->bahan_baku_id == $result->id ? "selected" : "" ?>><?= $result->nama_bahan_baku." (Rp. ".number_format($result->harga_satuan).")"; ?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Komposisi</label>
                                                            <input type="text" class="form-control komposisi" name="komposisi[]" placeholder="Komposisi" value="<?= $bom->komposisi ?>" required>
                                                        </div>        
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Satuan</label>
                                                            <input type="text" class="form-control satuan" name="satuan[]" placeholder="Satuan" value="<?= $bom->satuan ?>" required>
                                                        </div>         
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Jenis Bahan</label>
                                                            <select class="form-control keterangan" name="keterangan[]">
                                                                <option value="Bahan Baku" <?= $bom->keterangan == "Bahan Baku" ? "selected":"" ;  ?>>Bahan Baku</option>
                                                                <option value="Bahan Penolong" <?= $bom->keterangan == "Bahan Penolong" ? "selected":"" ;  ?>>Bahan Penolong</option>
                                                            </select>
                                                        </div>         
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                ?>
                                <div class="input-div input-test" style="display:none;">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Bahan Baku</label>
                                                <select name="bahan_baku_id[]" class="form-control" placeholder="Bahan Baku">
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
                                                <input type="text" class="form-control komposisi" name="komposisi[]" placeholder="Komposisi" value="">
                                            </div>        
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Satuan</label>
                                                <input type="text" class="form-control satuan" name="satuan[]" placeholder="Satuan" value="">
                                            </div>         
                                        </div>
                                    </div>
                                </div>
        
                            </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" id="submit" class="btn btn-primary">Submit</button>
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