<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Jurnal Umum
            <small>data</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form align="center" method="post"
                                action="<?php echo site_url().'/keuangan/jurnal' ?> "
                                class="form-inline">
                                <label>Tanggal Awal</label>
                                <input type="date" name="tgl_awal" class="form-control">
                                <label>Tanggal Akhir</label>
                                <input type="date" name="tgl_akhir" class="form-control">
                                <input type="submit" value="filter" class="btn btn-info">
                            </form>
                            <br>
                            <center>
                            <h4>Jurnal Umum</h4>
                            <h4>Bandung Clothing Corporation</h4>
                            <h4>Semua Periode</h4>
                            </center>
                            <br>
                            <table class="table table-bordered">
                                <tr align="center">
                                    <td>Tanggal Jurnal</td>
                                    <td>Keterangan</td>
                                    <td>Ref</td>
                                    <td>Debit</td>
                                    <td>Kredit</td>
                                </tr>
                                <?php 
                                    $total =0;
                                    $total2 =0;
                                    foreach ($jurnal as $data)
                                        {
                                            echo"
                                                <tr>
                                                    <td>".$data['tgl_transaksi']."</td>";
                                                    
                                            if ($data['posisi_dr_cr']=='debet')
                                            {
                                                
                                                echo"
                                                
                                                
                                                    <td>".$data['nama_akun']."</td>
                                                    <td>".$data['kode_akun']."</td>
                                                    <td align = 'right'>Rp. ".number_format($data['nominal'], 0, ",", ".")."</td>
                                                    <td align = 'right'></td>";
                                                    $total = $total+$data['nominal'];
                                            }else{
                                                echo"
                                                    <td align='center'>".$data['nama_akun']."</td>
                                                    <td>".$data['kode_akun']."</td>
                                                    <td align = 'right'></td>
                                                    <td align = 'right'>Rp. ".number_format($data['nominal'], 0, ",", ".")."</td>
                                </tr>";
                                $total2=$total2+$data['nominal'];
                                        }
                                    }
                                ?>
                                <tr>
                                    <td colspan="3" align='center'><b>Total</b></td>
                                    <td align="right"><b><?php echo "Rp. ".number_format($data['nominal'], 0, ",", ".") ; ?></b></td>
                                    <td align="right"><b><?php echo "Rp. ".number_format($data['nominal'], 0, ",", ".") ;?></b></td>
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