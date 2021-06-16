Content Wrapper. Contains page content -->
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
            <div class="col-md-12"> 
                    <?php if($this->session->flashdata('error_msg')){ ?>
                      <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                        <?= $this->session->flashdata('error_msg'); ?>
                      </div>
                    <?php }else if($this->session->flashdata('success_msg')){ ?>
                        <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!</h4>
                        <?= $this->session->flashdata('success_msg'); ?>
                      </div>
                    <?php } ?>
                </div>
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="<?= site_url('pemb_modal/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                    </div>  
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Kode Transaksi</th>
                                  <th>Tanggal</th>
                                  <th>Keterangan</th>
                                  <th>Total</th>
                                  <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($dataModal as $index => $result) {
                                        ?>
                                            <tr>
                                                <td><?= $index + 1; ?></td>
                                                <td><?= $result->id_modal; ?></td>
                                                <td><?= date("d F Y", strtotime($result->tgl_transaksi)); ?></td>
                                                <td><?= $result->keterangan; ?></td>
                                                <td><?= "Rp. ".number_format($result->total_transaksi, 0, ",", "."); ?></td>
                                                <!-- <td>
                                                    <a href="<?= site_url('pemb_modal/show/'.$result->id_modal) ?>" class="btn btn-info btn-sm"><i class="fa fa-th"></i></a>
                                                </td> -->
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
<!-- /.content-wrapper