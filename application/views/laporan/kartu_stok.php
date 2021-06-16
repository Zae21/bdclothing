<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Kartu Stok
            <small>data</small>
        </h1>
    </section>

    <!-- Main content -->

            <?php
              foreach ($kartuStok as $key) {
                $id_brg = $key['id_barang'];
                $nama = $key['nama_barang'];
              }
            ?>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    <center>
                        <h3>Bandung Clothing Corporatian</h3>
                        <h3>Kartu Stok Persediaan FIFO</h3>
                        <h3>Semua Periode</h3>
                    </center>
                    </div>  
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form class='form-inline' method="POST" class="form-inline"action="<?php echo site_url().'/Keuangan/kartuStok';?>">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label>Pilih Barang</label> 
                                                <select name="id_barang" class="form-control input-sm">
                                                    <option value="#" disabled selected>Pilih Barang</option>
                                                    <?php foreach($barang as $data){
                                                        echo "
                                                            <option value = ".$data->id.">".$data->nama_barang."</option>
                                                            ";
                                                        }
                                                        ?>
                                                </select>
                                            </div>
                                          </div>
<!-- 
                                        <div class="col-sm-2">
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
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Tahun</label>
                                                <select name="tahun" class="form-control">
                                                    <option value="" disabled selected>Pilih Tahun</option> <?php for ($i=2020; $i < 2025; $i++) {
                                                        echo "<option value". $i.">".$i."</option>"; } ?>
                                                </select>
                                            </div>
                                        </div> -->
                                        <div class="col-sm-3"><br>  
                                            <input class="btn btn-info btn-sm" type="submit" name="Submit"></input>
                                        </div>
                                    </div>
                                </form>
                            <table class="">
                              <tr>
                                <th>Id Barang</th>
                                <th>:</th>
                                <th><?=$id_brg?></th>
                              </tr>
                              <tr>
                                <th>Nama Barang</th>
                                <th>:</th>
                                <th><?=$nama?></th>
                              </tr>
                            </table>
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th rowspan="2" class="text-center">Tanggal</th>
                                  <th rowspan="2" class="text-center">Keterangan</th>
                                  <th colspan="3" class="text-center">Pembelian</th>
                                  <th colspan="3" class="text-center">Harga Pokok Penjualan</th>
                                  <th colspan="3" class="text-center">Persediaan</th>
                                </tr>
                                <tr>
                                  <th class="text-center">Unit</th>
                                  <th class="text-center">Harga/unit</th>
                                  <th class="text-center">Subtotal</th>
                                  <th class="text-center">Unit</th>
                                  <th class="text-center">Harga/unit</th>
                                  <th class="text-center">Subtotal</th>
                                  <th class="text-center">Unit</th>
                                  <th class="text-center">Harga/unit</th>
                                  <th class="text-center">Subtotal</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                    <td>-</td>
                                    <td>Saldo Awal</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                              <?php
                              foreach($kartuStok as $cacah):
                                  echo "<tr>";
                                  if ($cacah['keterangan'] == "Saldo Stok") {
                                    echo "<td></td>";
                                    echo "<td></td>";
                                  }else{
                                    echo "<td>".$cacah['tanggal']."</td>";
                                    echo "<td>".$cacah['keterangan']." | ".$cacah['id_transaksi']."</td>";
                                  }
                                    echo "<td>".($cacah['jml_masuk'] <= 0 ? "-" : number_format($cacah['jml_masuk']))."</td>";
                                    echo "<td align='right'>".($cacah['harga'] <=0 ? "-" : "Rp.".number_format($cacah['harga']))."</td>";
                                    echo "<td align='right'>".($cacah['harga'] <=0 ? "-" : "Rp.".number_format($cacah['harga']*$cacah['jml_masuk']))."</td>";
                                    echo "<td>".($cacah['jml_keluar'] <= 0 ? "-" : number_format($cacah['jml_keluar']))."</td>";
                                    echo "<td align='right'>".($cacah['hpp'] <=0 ? "-" : "Rp.".number_format($cacah['hpp']))."</td>";
                                    echo "<td align='right'>".($cacah['hpp'] <=0 ? "-" : "Rp.".number_format($cacah['hpp']*$cacah['jml_keluar']))."</td>";
                                    echo "<td>".$cacah['jml_saldo']."</td>";
                                    echo "<td align='right'>Rp.".number_format($cacah['harga_saldo'])."</td>";
                                    echo "<td align='right'>Rp.".number_format($cacah['harga_saldo']*$cacah['jml_saldo'])."</td>";

                                  echo "</tr>"; 
                              endforeach;     
                             
                              ?>
                              </tbody>
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