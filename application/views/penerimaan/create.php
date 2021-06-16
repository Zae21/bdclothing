<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
            Penerimaan Barang
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
                            <a href="<?= site_url('penerimaan') ?>" class="btn btn-success"><i class="fa fa-chevron-left"></i> Kembali</a>
                        </div>

                        <div class="box-body">
                                <div class="form-group">
                                    <label>Kode Penerimaan</label>
                                    <input type="text" class="form-control" placeholder="Kode Penerimaan" value="<?= $kode_penerimaan ?>" name="id" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Penerimaan</label>
                                    <input type="text" class="form-control" value="<?= date('d F Y') ?>" placeholder="Tanggal Pembelian" name="tanggal_transaksi" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Pengadaan</label>
                                    <select class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                        <option value="<?= site_url('penerimaan/create') ?>">[ Pilih Id Pengadaan ]</option>
                                        <?php
                                            foreach($dataPengadaan as $availablePesanan) {
                                        ?>
                                            <option value="<?= site_url('penerimaan/create?pengadaan_id='.$availablePesanan->id_transaksi) ?>" <?= $this->input->get('pengadaan_id', TRUE) == $availablePesanan->id_transaksi ? "selected" : "" ?>><?= $availablePesanan->id_transaksi ?></option>
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
                                                <th>Total Pembelian Bahan Baku</th>
                                                <th>Total Ongkos Produksi</th>
                                                <th>Total Biaya Lainnya</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <form action="<?= site_url('penerimaan/store/') ?>" method="POST">
                                            
                                        <?php
                                            // $totalPesanan = 0;

                                            foreach($dataDetailPengadaan as $index => $result) { ?>
                                            <tr>
                                                <input type="text" name="id_penerimaan[]" value="<?= $kode_penerimaan ?>" hidden="">
                                                <td><?= $index + 1; ?></td>
                                                <td><?= $result->id_barang; ?>  <input type="text" name="id_barang[]" value="<?= $result->id_barang; ?>" hidden=""></td>
                                                <td><?= $result->nama_barang; ?> </td>
                                                <td><?= $result->qty; ?>  <input type="text" name="qty[]" value="<?= $result->qty; ?>" hidden=""></td>
                                                <?php                                                    
                                                    $this->db->select('*, sum((qty*komposisi)*bahan_baku.harga_satuan) as jumlah_kebutuhan')
                                                            ->from('detail_pengadaan')
                                                            ->join('bom', 'bom.barang_id=detail_pengadaan.id_barang')
                                                            ->join('detail_bom', 'detail_bom.bom_id=bom.id')
                                                            ->join('barang', 'bom.barang_id=barang.id')
                                                            ->join('bahan_baku', 'detail_bom.bahan_baku_id=bahan_baku.id')
                                                            ->where(array('id_transaksi' => $pengadaan->id_transaksi, 'barang_id'=> $result->id_barang))
                                                            ->group_by('id_barang');
                                                    $query = $this->db->get()->result(); 
                                                    foreach ($query as $val) { ?>

                                                <td align="right"><?= "Rp. ".number_format($val->jumlah_kebutuhan); ?>
                                                    <input type="text" name="biaya_bahan_baku[]" value="<?= $val->jumlah_kebutuhan; ?>" hidden="">
                                                </td>
                                                <td><input type="text" name="biaya_produksi[]" value=""></td>
                                                <td><input type="text" name="biaya_tambahan[]" value=""></td>
                                                <?php    }
                                                ?>
                                            </tr>
                                        <?php
                                            // $totalPesanan += $result->sub_total;
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    
                               
                                </div>

                                <input type="text" name="id_pengadaan" value="<?= $pengadaan->id_transaksi ?>" hidden="">
                            <?php
                                }
                            ?>
                            </div>
                            <div>
                                <input type="submit" name="submit" class="btn btn-success">
                            </div>   
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