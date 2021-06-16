<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Barang
            <small>data</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
            <div class="col-md-12"> 
             <?php if($this->session->flashdata('error_msg')){ ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                        <?= $this->session->flashdata('error_msg'); ?>
                </div>
            <?php }else if($this->session->flashdata('succses_msg')){ ?>
                <div class="alert with-close alert-success alert-dismissible fade show">
                    <span class="badge badge-pill badge-success">Berhasil</span>
                    <?= $this->session->flashdata('succses_msg'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
            </div>
                <div class="box">
                    <div class="box-header">
                        <a href="<?= site_url('barang/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                    </div>  
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Nama Barang</th>
                                  <th>Kategori Barang</th>
                                  <th>Harga Jual Satuan</th>
                                  <th>Harga Produk Satuan</th>
                                  <th>Stok</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($result as $index => $data) {
                                        ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= $data->nama_barang ?></td>
                                                <td><?= $data->nama ?></td>
                                                <td><?= 'Rp. '.number_format($data->harga_jual_satuan, 0, ",",".") ?></td>
                                                <td><?= 'Rp. '.number_format($data->harga_produk_satuan, 0, ",",".") ?></td>
                                                <td><?= $data->stok ?></td>
                                                <td>
                                                    <a href="<?= site_url('barang/edit/'.$data->id) ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                                    
                                                </td>
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