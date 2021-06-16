<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
            Pembelian
          <small>Tambah Data</small>
      </h1>
  </section>
  <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <a href="<?= site_url('pembelian') ?>" class="btn btn-success"><i class="fa fa-chevron-left"></i> Kembali</a>
                        </div>

                        <div class="box-body">
                                <div class="form-group">
                                    <label>Kode Pembelian</label>
                                    <input type="text" class="form-control" placeholder="Kode Pembelian" value="<?= $kode_pembelian ?>" name="id" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Pembelian</label>
                                    <input type="text" class="form-control" value="<?= date('d F Y') ?>" placeholder="Tanggal Pembelian" name="tanggal_transaksi" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Pesanan</label>
                                    <select class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                        <option value="<?= site_url('pembelian/create') ?>">[ Pilih Id Pengadaan ]</option>
                                        <?php
                                            foreach($dataPengadaan as $availablePesanan) {
                                        ?>
                                            <option value="<?= site_url('pembelian/create?pengadaan_id='.$availablePesanan->id_transaksi) ?>" <?= $this->input->get('pengadaan_id', TRUE) == $availablePesanan->id_transaksi ? "selected" : "" ?>><?= $availablePesanan->id_transaksi ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                
                            <div class="table-responsive">
                            <?php
                                if(!empty($pengadaan)) { ?>
                                    <table class="table">
                                        <tr>
                                            <th width="250px">Id Pengadaan</th>
                                            <td width="50px">:</td>
                                            <td><?= $pengadaan->id_transaksi ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Pengadaan</th>
                                            <td>:</td>
                                            <td><?= date('d F Y', strtotime($pengadaan->tanggal_transaksi)) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>:</td>
                                            <td>
                                                <?php if($pengadaan->status == 1) { ?>
                                                    <label for="" class="label label-info">Dalam Proses Pengadaan</label>
                                                <?php } else if($pengadaan->status == 2) { ?>
                                                    <label for="" class="label label-warning">Dalam Pembelian</label>
                                                <?php } else { ?>
                                                    <label for="" class="label label-success">Selesai</label>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="box-title">
                                        <h3>Detail Barang</h3>
                                    </div>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Barang</th>
                                                <th>Barang</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            // $totalPesanan = 0;
                                            foreach($dataDetailPengadaan as $index => $result) { ?>
                                            <tr>
                                                <td><?= $index + 1; ?></td>
                                                <td><?= $result->id_barang; ?></td>
                                                <td><?= $result->nama_barang; ?></td>
                                                <td><?= $result->qty; ?></td>
                                            </tr>
                                        <?php
                                            // $totalPesanan += $result->sub_total;
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <div class="box-title">
                                        <h3>Detail Bahan Baku</h3>
                                    </div>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Bahan Baku</th>
                                                <th>Bahan Baku</th>
                                                <th>Jumlah Pengadaan</th>
                                                <th>Satuan</th>
                                                <th>Harga Satuan</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $total = 0;
                                                foreach($dataKebutuhan as $index => $result) {
                                                    ?>
                                                        <tr>
                                                            <td><?= $index + 1; ?></td>
                                                            <td><?= $result->bahan_baku_id; ?></td>
                                                            <td><?= $result->nama_bahan_baku; ?></td>
                                                            <td><?= $result->jumlah_kebutuhan; ?></td>
                                                            <td><?= $result->satuan; ?></td>
                                                            <td><?= "Rp. ".number_format($result->harga_satuan); ?></td>
                                                            <td><?= "Rp. ".number_format($result->jumlah_kebutuhan*$result->harga_satuan); ?></td>
                                                        </tr>
                                                    <?php
                                                    $total = $total+($result->jumlah_kebutuhan*$result->harga_satuan);
                                                }
                                            ?>
                                            <tr>
                                                <th colspan="6">Total Pembelian</th>
                                                <th><?= "Rp. ".number_format($total); ?></th>
                                            </tr>
                                        </tbody>
                                    </table> 
                               
                                </div>

                                <form action="<?= site_url('pembelian/pembelianselesai/'.$pengadaan->id_transaksi) ?>" method="POST">
                                    <div class="form-group">
                                        <label>Total Transaksi</label>
                                        <input type="text" class="form-control" placeholder="Total Transaksi" value="Rp. <?= number_format($total, 0, ",", ".") ?>" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Pemasok</label>
                                        <select name="pemasok_id" id="" class="form-control" required>
                                            <option value="">[ Pilih Pemasok ]</option>
                                            <?php
                                                foreach($dataPemasok as $pemasok) {
                                                    ?>
                                                        <option value="<?= $pemasok->id ?>"><?= $pemasok->id ?> - <?= $pemasok->nama ?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit"> Pembelian Selesai</button>
                                    </div>

                                </form>
                            <?php
                                }
                            ?>
                            </div>
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