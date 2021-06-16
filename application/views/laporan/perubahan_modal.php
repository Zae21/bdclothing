<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Perubahan Modal
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
                        <form align="center" method="post" action="<?php echo site_url().'/keuangan/per_modal' ?> " class="form-inline">
                    <div class="row">
                      <div class="col-sm-5">
                        <div class="form-group">
                          <label>Bulan</label>
                            <select name="bulan" class="form-control">
                              <option value="" disabled selected>Pilih Bulan</option>
                              <option value="01">Jan</option>
                              <option value="02">Feb</option>
                              <option value="03">Mar</option>
                              <option value="04">Apr</option>
                              <option value="05">Mei</option>
                              <option value="06">Jun</option>
                              <option value="07">Jul</option>
                              <option value="08">Agt</option>
                              <option value="09">Sept</option>
                              <option value="10">Okt</option>
                              <option value="11">Nov</option>
                              <option value="12">Des</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-5">
                          <div class="form-group">
                            <label>Tahun</label>
                            <select name="tahun" class="form-control">
                              <option value="" disabled selected>Pilih Tahun</option> <?php for ($i=2020; $i < 2025; $i++) {
                                echo "<option value". $i.">".$i."</option>"; } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <input type="submit" value="filter" name="submit" class="btn btn-info">
                  </form>
                            <br>
                            <center>
                            <h4>Bandung clothing corpolation</h4>
                            <h4><?= $title ?></h4>
                            <?php if($this->input->post('submit')){
                              $tgl = $this->input->post('tahun')."-".$this->input->post('bulan')."-01";
                            ?>
                              <h4>Periode <?= date('M', strtotime($tgl)) ?> - <?= $this->input->post('tahun')?></h4>
                            <?php }else{?>
                              <h4>Periode <?= date('M-Y') ?></h4>
                            <?php } ?>
                            </center>
                            <br>
                            <table class="table">
                                <tr><?php $saldo_awal = $debit->saldo_awal_debit + $kredit->saldo_awal_kredit; ?>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td><b>Modal Awal</b></td>
                                    <td>&nbsp;</td>
                                    <td align="right"><b><?= "Rp. ".number_format($saldo_awal) ;?></b></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td><b>Pertambahan Modal Periode Berjalan</b></td>
                                    <td align="right"><b><?php echo "Rp. ".number_format($permodal) ; ?></b></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td><b><?= $laba>0?"Laba":"Rugi" ?> Periode Berjalan</b></td>
                                    <td align="right"><b><?php 
                                      if ($laba<0) {
                                        $angka = $laba*-1;
                                        echo "(Rp. ".number_format($angka).")";
                                      }else{
                                        echo "Rp. ".number_format($laba) ; 
                                      }
                                    ?></b></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>

                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td><b>Prive</b></td>
                                    <td align="right"><b>(<?php echo "Rp. ".number_format($prive) ; ?>)</b></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php $total = $permodal+$laba-$prive?>

                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td><b><?= $total>0?"Pertambahan Modal":"Pengurangan Modal" ?></b></td>
                                    <td>&nbsp;</td>
                                    <td align="right"><b>
                                      <?php 
                                      if ($total<0) {
                                        $angka = $total*-1;
                                        echo "(Rp. ".number_format($angka).")";
                                      }else{
                                        echo "Rp. ".number_format($total) ; 
                                      }
                                        $md= $saldo_awal+$total;
                                    ?>
                                      </b></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td><b>Modal Akhir</b></td>
                                    <td>&nbsp;</td>
                                    <td align="right"><b><?php echo "Rp. ".number_format($md) ; ?></b></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                

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