<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Penjualan
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
                        <form align="center" method="post" action="<?php echo site_url().'/keuangan/laba_rugi' ?> " class="form-inline">
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
                            <h4>Bandung Clothing Corporation</h4>
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
                            <table class="table table-borderless">
                                <tr>
                                    <th>Pendapatan</td>
                                </tr>
                                <?php 
                                    $total =0;
                                    foreach ($pendapatan as $data)
                                        { ?>
                                              <td><?= $data['nama_akun']?></td>
                                              <td align = 'right'>Rp. 
                                              <?php
                                              if(isset($_POST['bulan']) ){
                                                $bulan = $_POST['bulan'];
                                              }else{
                                                $bulan = date('m');
                                              }

                                              if(isset($_POST['tahun']) ){
                                                $tahun = $_POST['tahun'];
                                              }else{
                                                $tahun = date('Y');
                                              }
                                                $this->db->where('MONTH(tgl_transaksi)', $bulan);
                                                $this->db->where('YEAR(tgl_transaksi)', $tahun);
                                                $this->db->where('kode_akun', $data['kode_akun']);
                                                $this->db->where('posisi_dr_cr', 'debet');
                                                $this->db->select('sum(nominal) as saldo_debet');
                                                $this->db->from('jurnal');
                                                $query = $this->db->get(); 
                                                $saldo_debet =  $query->row()->saldo_debet;


                                                $this->db->where('MONTH(tgl_transaksi)', $bulan);
                                                $this->db->where('YEAR(tgl_transaksi)', $tahun);
                                                $this->db->where('kode_akun', $data['kode_akun']);
                                                $this->db->where('posisi_dr_cr', 'kredit');
                                                $this->db->select('sum(nominal) as saldo_kredit');
                                                $this->db->from('jurnal');
                                                $qry = $this->db->get(); 
                                                $saldo_kredit =  $qry->row()->saldo_kredit;

                                                $nominal = $saldo_kredit - $saldo_debet;
                                                echo number_format($nominal, 0, ",", ".")
                                              ?>
                                              </td>
                                              <td></td>
                                            </tr>
                                <?php
                                    $total = $total+$nominal;
                                        // $saldo_awal = $debit->saldo_awal_debit - $kredit->saldo_awal_kredit;
                                        }
                                ?>
                                <tr>
                                    <td align="center"><b>Total Pendapatan</b></td>
                                    <td align="right" colspan="2"><b><?php echo "Rp. ".number_format($total, 0, ",", ".") ; ?></b></td>
                                </tr>

                                <tr>
                                    <th>Beban - Beban</td>
                                </tr>
                                <?php 
                                    $total2 =0;
                                    foreach ($beban as $data)
                                        { ?>
                                              <td><?= $data['nama_akun']?></td>
                                              <td align = 'right'>Rp. 
                                              <?php
                                              if(isset($_POST['bulan']) ){
                                                $bulan = $_POST['bulan'];
                                              }else{
                                                $bulan = date('m');
                                              }

                                              if(isset($_POST['tahun']) ){
                                                $tahun = $_POST['tahun'];
                                              }else{
                                                $tahun = date('Y');
                                              }
                                                $this->db->where('MONTH(tgl_transaksi)', $bulan);
                                                $this->db->where('YEAR(tgl_transaksi)', $tahun);
                                                $this->db->where('kode_akun', $data['kode_akun']);
                                                $this->db->where('posisi_dr_cr', 'debet');
                                                $this->db->select('sum(nominal) as saldo_debet');
                                                $this->db->from('jurnal');
                                                $query = $this->db->get(); 
                                                $saldo_debet =  $query->row()->saldo_debet;


                                                $this->db->where('MONTH(tgl_transaksi)', $bulan);
                                                $this->db->where('YEAR(tgl_transaksi)', $tahun);
                                                $this->db->where('kode_akun', $data['kode_akun']);
                                                $this->db->where('posisi_dr_cr', 'kredit');
                                                $this->db->select('sum(nominal) as saldo_kredit');
                                                $this->db->from('jurnal');
                                                $qry = $this->db->get(); 
                                                $saldo_kredit =  $qry->row()->saldo_kredit;

                                                $nominal = $saldo_debet - $saldo_kredit;
                                                echo number_format($nominal, 0, ",", ".")
                                              ?>
                                              </td>
                                              <td></td>
                                            </tr>
                                <?php
                                    $total2 = $total2+$nominal;
                                        // $saldo_awal = $debit->saldo_awal_debit - $kredit->saldo_awal_kredit;
                                        }
                                ?>
                                <tr>
                                    <td align="center"><b>Total Beban</b></td>
                                    <td align="right" colspan="2"><b><?php echo "Rp. ".number_format($total2, 0, ",", ".") ; ?></b></td>
                                </tr>
                                <?php 
                                  $lr = $total - $total2;
                                ?>
                                <tr>
                                    <td align="center"><b>Total <?= ($lr < 0 ? "Rugi" : "Laba"); ?></b></td>
                                    <td align="right" colspan="2"><b><?php echo "Rp. ".number_format($lr, 0, ",", ".") ; ?></b></td>
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