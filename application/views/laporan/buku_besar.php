<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Buku Besar
            <small>data</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box"><br>
                <div class="col-xs-12">
                    <form class='form-inline' method="POST" class="form-inline"
                            action="<?php echo site_url().'/keuangan/buku_besar';?>">
                            
                            <div class="form-group">
                                <label>Pilih Akun</label> 
                                <select name="kode_akun" class="form-control input-sm">
                                    <option value="#" disabled selected>Pilih Akun</option>
                                    <?php foreach($akun as $data){
                                        echo "
                                            <option value = ".$data['kode_akun'].">".$data['nama_akun']."</option>
                                            ";
                                        }
                                        ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Bulan</label> 
                                <select name="bulan" class="form-control">
                                    <option value="" disabled selected>Pilih Bulan</option>
                                    <option value="1">Jan</option>
                                    <option value="2">Feb</option>
                                    <option value="3">Mar</option>
                                    <option value="4">Apr</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Jun</option>
                                    <option value="7">Jul</option>
                                    <option value="8">Agt</option>
                                    <option value="9">Sept</option>
                                    <option value="10">Okt</option>
                                    <option value="11">Nov</option>
                                    <option value="12">Des</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tahun</label>
                                <select name="tahun" class="form-control">
                                    <option value="" disabled selected>Pilih Tahun</option> <?php for ($i=2017; $i < 2025; $i++) {
                                        echo "<option value". $i.">".$i."</option>"; } ?>
                                </select>
                            </div>
                            <button class="btn btn-info btn-sm" type="submit" name="submit">Submit</button>
                        </form>
                </div><br>
                <div class="box-header">
                    <center>
                        <h3>Bandung Clothing Corporatian</h3>
                        <h3>Buku Besar</h3>
                        <h3>Semua Periode</h3>
                    </center>
                    </div>  
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <tr>
                                <th rowspan=2>Tanggal</th>
                                <th rowspan=2>Keterangan</th>
                                <th rowspan=2>Reff</th>
                                <th rowspan=2>Debit</th>
                                <th rowspan=2>Kredit</th>
                                <th colspan=2>Saldo</th>
                            </tr>
                            <tr>
                                <th>Debit</th>
                                <th>Kredit</th>
                            </tr>
                            <?php
                                $saldo_awal=0;
                                if(isset($_POST['bulan']) && isset($_POST['tahun'])){
                                    if($dataakun['header_akun'] == 11 or $dataakun['header_akun'] == 5 or $dataakun['header_akun'] == 6){  
                                        $saldo_awal = $debit->saldo_awal_debit - $kredit->saldo_awal_kredit;
                                    }else{
                                        $saldo_awal = $debit->saldo_awal_debit + $kredit->saldo_awal_kredit;
                                    }
                                }
                                echo "
                                <tr>
                                <th>00-00-0000</th>
                                <th>Saldo Awal</th>
                                <th></th>
                                <th></th>
                                <th></th>";
                                if((($dataakun['header_akun'] == 11 or $dataakun['header_akun'] == 5 or $dataakun['header_akun'] == 6) and $saldo_awal>0) or (($dataakun['header_akun'] == 2 or $dataakun['header_akun'] == 4 or $dataakun['header_akun'] == 3 ) and $saldo_awal<0)){  
                                    echo "<td align = 'right'><b>".format_rp($saldo_awal)."</b></td>";
                                }else{
                                    echo "<td></td>";
                                }

                                if((($dataakun['header_akun'] == 11 or $dataakun['header_akun'] == 5 or $dataakun['header_akun'] == 6) and $saldo_awal>0) or (($dataakun['header_akun'] == 2 or $dataakun['header_akun'] == 4 or $dataakun['header_akun'] == 3 ) and $saldo_awal<0)){  
                                    echo "<td></td>";
                                }else{
                                    echo "<td align = 'right'><b>".format_rp($saldo_awal)."</b></td>";
                                }
                                echo "
                                </tr>
                                    ";

                                        foreach($jurnal as $data){
                                        echo "
                                            <tr>
                                                <td>".$data['tgl_transaksi']."</td>
                                                <td>".$data['nama_akun']."</td>
                                                <td>".$data['kode_akun']."</td>
                                            ";
                                        if($data['posisi_dr_cr'] == 'debet'){
                                            //if($dataakun['header_akun'] == d or $dataakun['header_akun'] == 5 or $dataakun['header_akun'] == 6){
                                            if($dataakun['header_akun'] == 11 or $dataakun['header_akun'] == 5 or $dataakun['header_akun'] == 6 ){  
                                                $saldo_awal = $saldo_awal + $data['nominal'];
                                            }else{
                                                $saldo_awal = $saldo_awal - $data['nominal'];
                                            }
                                            echo "
                                                <td align = 'right'>".format_rp($data['nominal'])."</td>
                                                <td></td>";
                                                if((($dataakun['header_akun'] == 11 or $dataakun['header_akun'] == 5 or $dataakun['header_akun'] == 6) and $saldo_awal>0) or (($dataakun['header_akun'] == 2 or $dataakun['header_akun'] == 4 or $dataakun['header_akun'] == 3 ) and $saldo_awal<0)){  
                                                    echo "<td align = 'right'>".format_rp($saldo_awal)."</td>";
                                                }else{
                                                    echo "<td></td>";
                                                }

                                                if((($dataakun['header_akun'] == 11 or $dataakun['header_akun'] == 5 or $dataakun['header_akun'] == 6) and $saldo_awal>0) or (($dataakun['header_akun'] == 2 or $dataakun['header_akun'] == 4 or $dataakun['header_akun'] == 3 ) and $saldo_awal<0)){  
                                                    echo "<td></td>";
                                                }else{
                                                    echo "<td align = 'right'>".format_rp($saldo_awal)."</td>";
                                                }
                                           
                                            echo "
                                            </tr>
                                            ";
                                        }else{
                                            if($dataakun['header_akun'] == 11 or $dataakun['header_akun'] == 5 or $dataakun['header_akun'] == 6){
                                                $saldo_awal = $saldo_awal - $data['nominal'];
                                            }else{
                                                $saldo_awal = $saldo_awal + $data['nominal'];
                                            }
                                            
                                            echo "
                                                <td></td>
                                                <td align = 'right'>".format_rp($data['nominal'])."</td>";
                                                if((($dataakun['header_akun'] == 11 or $dataakun['header_akun'] == 5 or $dataakun['header_akun'] == 6) and $saldo_awal>0) or (($dataakun['header_akun'] == 2 or $dataakun['header_akun'] == 4 or $dataakun['header_akun'] == 3 ) and $saldo_awal<0)){  
                                                    echo "<td align = 'right'>".format_rp($saldo_awal)."</td>";
                                                }else{
                                                    echo "<td></td>";
                                                }

                                                if((($dataakun['header_akun'] == 11 or $dataakun['header_akun'] == 5 or $dataakun['header_akun'] == 6) and $saldo_awal>0) or (($dataakun['header_akun'] == 2 or $dataakun['header_akun'] == 4 or $dataakun['header_akun'] == 3 ) and $saldo_awal<0)){  
                                                    echo "<td></td>";
                                                }else{
                                                    echo "<td align = 'right'>".format_rp($saldo_awal)."</td>";
                                                }
                                           
                                            echo "
                                                
                                            </tr>
                                            ";
                                        }
                                }
                                echo "
                                <tr>
                                    <th>00-00-0000</th>
                                    <th>Saldo Akhir</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>";
                                    if((($dataakun['header_akun'] == 11 or $dataakun['header_akun'] == 5 or $dataakun['header_akun'] == 6) and $saldo_awal>0) or (($dataakun['header_akun'] == 2 or $dataakun['header_akun'] == 4 or $dataakun['header_akun'] == 3 ) and $saldo_awal<0)){  
                                        echo "<td align = 'right'><b>".format_rp($saldo_awal)."</b></td>";
                                    }else{
                                        echo "<td></td>";
                                    }
                                    if((($dataakun['header_akun'] == 11 or $dataakun['header_akun'] == 5 or $dataakun['header_akun'] == 6) and $saldo_awal>0) or (($dataakun['header_akun'] == 2 or $dataakun['header_akun'] == 4 or $dataakun['header_akun'] == 3 ) and $saldo_awal<0)){  
                                        echo "<td></td>";
                                    }else{
                                        echo "<td align = 'right'><b>".format_rp($saldo_awal)."</b></td>";
                                    }
                                echo "
                                </tr>
                                ";
                            ?>
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