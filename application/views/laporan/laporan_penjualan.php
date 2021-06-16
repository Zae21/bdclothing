<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Laporan Penjualan
            <small>data</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    <center>
                        <h3>Bandung Clothing Corporatian</h3>
                        <h3>Laporan Penjualan Bulanan</h3>
                        <h3>Semua Periode</h3>
                    </center>
                    </div>  
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Periode</th>
                                  <th>Total Penjualan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($result as $index => $data) {
                                        ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= $data->bulan." - ".$data->tahun?></td>
                                                <td><?= 'Rp. '.number_format($data->total, 0, ",",".") ?></td>
                                            </tr>
                                        <?php
                                    }
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