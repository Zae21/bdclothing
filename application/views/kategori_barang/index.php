<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Kategori Barang
            <small>data</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="<?= site_url('kategoribarang/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                    </div>  
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Kode</th>
                                  <th>Nama Kategori</th>
                                  <th>Banner Kategori</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($result as $index => $data) {
                                        ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= $data->id ?></td>
                                                <td><?= $data->nama ?></td>
                                                <td class="text-center">
                                                    <a href="<?php echo base_url('upload/KatBarang/'.$data->gambar) ?>" class="perbesar">
                                                    <img src="<?php echo base_url('upload/KatBarang/'.$data->gambar) ?>" class="img-thumbnail" width="64" />
                                                </td>
                                                <td>
                                                    <a href="<?= site_url('kategoribarang/edit/'.$data->id) ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
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

<script>
$(document).ready(function() {
    $('#example').DataTable( {
        "pagingType": "full_numbers"
    } );
    $(".perbesar").fancybox();
} );
</script>