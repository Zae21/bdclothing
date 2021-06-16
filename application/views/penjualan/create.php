<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
            Penjualan
          <small>Tambah Data</small>
      </h1>
  </section>

  <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
                <div class="col-md-12"> 
                    <?php if($this->session->flashdata('error_msg')){ ?>
                      <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                        <?= $this->session->flashdata('error_msg'); ?>
                      </div>
                    <?php }else if($this->session->flashdata('succses_msg')){ ?>
                        <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                        <?= $this->session->flashdata('success_msg'); ?>
                      </div>
                    <?php } ?>
                </div>
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <a href="<?= site_url('penjualan') ?>" class="btn btn-success"><i class="fa fa-chevron-left"></i> Kembali</a>
                        </div>

                        <div class="box-body">
                            <form action="<?= site_url('penjualan/simpanbarang') ?>" method="POST">
                                <div class="form-group">
                                    <label>Kode Penjualan</label>
                                    <input type="text" class="form-control" placeholder="Kode Penjualan" value="<?= $kode_penjualan ?>" name="id" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Penjualan</label>
                                    <input type="text" class="form-control" value="<?= date('d F Y') ?>" placeholder="Tanggal Penjualan" name="tanggal_transaksi" readonly>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Barang</label>
                                            <input list="barang" name="barang_id" placeholder="Pilih Barang" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Jumlah Penjualan</label>
                                            <input type="number" name="jumlah_penjualan" class="form-control" value="" placeholder="Jumlah Penjualan" required>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Action</label>
                                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            <!-- /.box-body -->
                            </form>
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>Kode Bahan Baku</th>
                                    <th>Bahan Baku</th>
                                    <th>Harga Satuan</th>
                                    <th>Jumlah Penjualan</th>
                                    <th>Sub Total</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $totalPenjualan = 0;
                                        foreach($dataDetail as $index => $result) {
                                            ?>
                                                <tr>
                                                    <td><?= $index + 1; ?></td>
                                                    <td><?= $result->barang_id; ?></td>
                                                    <td><?= $result->nama_barang; ?></td>
                                                    <td><?= "Rp. ".number_format($result->harga_satuan, 0, ",", "."); ?></td>
                                                    <td><?= $result->jumlah_penjualan; ?></td>
                                                    <td><?= "Rp. ".number_format($result->sub_total, 0, ",", ".") ?></td>
                                                    <td>
                                                        <a onclick="deleteConfirm('<?php echo site_url('penjualan/deleteitem/'.$result->id.'/'.$result->barang_id.'/'.$result->jumlah_penjualan) ?>')" href="#!" class="btn btn-danger btn-sm">
                                                            <span class="glyphicon glyphicon-trash"></span>
                                                         </a>
                                                    </td>
                                                </tr>
                                            <?php
                                            $totalPenjualan += $result->sub_total;
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <br>
                            <br>
                            <form action="<?= site_url('penjualan/penjualanselesai') ?>" method="POST">
							    <input type="hidden" class="form-control" name="id"  value="<?= $kode_penjualan ?>">
                                <div class="form-group">
                                    <label>Total Transaksi</label>
                                    <input type="text" class="form-control" placeholder="Kode Pelanggan" value="Rp. <?= number_format($totalPenjualan, 0, ",", ".") ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Pelanggan</label>
                                    <select name="pelanggan_id" id="" class="form-control" required>
                                        <option value="">[ Pilih Pelanggan ]</option>
                                        <?php
                                            foreach($dataPelanggan as $pelanggan) {
                                                ?>
                                                    <option value="<?= $pelanggan->id ?>"><?= $pelanggan->id ?> - <?= $pelanggan->nama ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit"> Penjualan Selesai</button>
                                </div>
                            <!-- /.box-body -->
                            </form>
                        </div>
                      
                    </div>
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
   <datalist id="barang">
        <?php
           foreach($dataBarang as $barang) { ?>
            <option value="<?= $barang->id ?>"><?= $barang->nama ?> - <?= $barang->id ?> - <?= $barang->nama_barang ?> (Rp. <?= number_format($barang->harga_jual_satuan, 0, ",", ".") ?>)</option>
        <?php } ?>
    </datalist>

    <script>
$(document).ready(function() {
    $('#example').DataTable( {
        "pagingType": "full_numbers"
    } );
} );
</script>
<script>
function deleteConfirm(url){
  $('#btn-delete').attr('href', url);
  $('#deleteModal').modal();
}
</script>
<!-- Logout Delete Confirmation-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">X</span>
        </button>
      </div>
      <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batalkan</button>
        <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>
      </div>
    </div>
  </div>
</div>