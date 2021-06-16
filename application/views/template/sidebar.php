
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= base_url('assets')?>/dist/img/people.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= $this->session->userdata("username") ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?=  $this->uri->segment(1) == 'dashboard' ? 'active': '' ?>"><a href="<?= site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>        
            <li class="treeview <?= $this->uri->segment(1) == 'kategoribarang' || $this->uri->segment(1) == 'akun' || $this->uri->segment(1) == 'pemasok' || $this->uri->segment(1) == 'barang' || $this->uri->segment(1) == 'bahanbaku' || $this->uri->segment(1) == 'bom' || $this->uri->segment(1) == 'kategoribeban' || $this->uri->segment(1) == 'pelanggan' ? 'active': '' ?>">
                <a href="#">
                    <i class="fa fa-address-card"></i> <span>Data Master</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= $this->uri->segment(1) == 'kategoribarang' ? 'active': '' ?>"><a href="<?= site_url('kategoribarang') ?>"><i class="fa fa-circle-o"></i> Kategori Barang</a></li>
                    <li class="<?= $this->uri->segment(1) == 'barang' ? 'active': '' ?>"><a href="<?= site_url('barang') ?>"><i class="fa fa-circle-o"></i> Barang</a></li>
                    <?php
                        if($this->session->userdata('level') == 2) {
                            ?>
                                <li class="<?= $this->uri->segment(1) == 'bahanbaku' ? 'active': '' ?>"><a href="<?= site_url('bahanbaku') ?>"><i class="fa fa-circle-o"></i> Bahan Baku</a></li>
                                <li class="<?= $this->uri->segment(1) == 'bom' ? 'active': '' ?>"><a href="<?= site_url('bom') ?>"><i class="fa fa-circle-o"></i> BOM</a></li>   
                                <li class="<?= $this->uri->segment(1) == 'pemasok' ? 'active': '' ?>"><a href="<?= site_url('pemasok') ?>"><i class="fa fa-circle-o"></i> Pemasok</a></li> 
                            <?php
                        }
                    ?>
                    <?php
                        if($this->session->userdata('level') == 1) {
                            ?>
                                <li class="<?= $this->uri->segment(1) == 'kategoribeban' ? 'active': '' ?>"><a href="<?= site_url('kategoribeban') ?>"><i class="fa fa-circle-o"></i> Kategori Beban</a></li>
                                <li class="<?= $this->uri->segment(1) == 'pelanggan' ? 'active': '' ?>"><a href="<?= site_url('pelanggan') ?>"><i class="fa fa-circle-o"></i> Pelanggan</a></li>
                            <?php
                        }
                    ?>                    
                     <li class="<?= $this->uri->segment(1) == 'akun' ? 'active': '' ?>"><a href="<?= site_url('akun') ?>"><i class="fa fa-circle-o"></i> Akun</a></li>
                </ul>
            </li> 
            <li class="treeview <?= $this->uri->segment(1) == 'penjualan' || $this->uri->segment(1) == 'penjualan_online' || $this->uri->segment(1) == 'pembayaran' || $this->uri->segment(1) == 'pemb_modal' || $this->uri->segment(1) == 'pembelian' ? 'active': '' ?>">
                <a href="#">
                    <i class="fa fa-money"></i> <span>Transaksi</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <?php
                        if($this->session->userdata('level') == 1) {
                            ?>
                                <li class="<?= $this->uri->segment(1) == 'penjualan' ? 'active': '' ?>"><a href="<?= site_url('penjualan') ?>"><i class="fa fa-circle-o"></i> Penjualan</a></li>
                                <li class="<?= $this->uri->segment(1) == 'penjualan_online' ? 'active': '' ?>"><a href="<?= site_url('penjualan_online') ?>"><i class="fa fa-circle-o"></i> Penjualan Online</a></li>
                                <li class="<?= $this->uri->segment(1) == 'pembayaran' ? 'active': '' ?>"><a href="<?= site_url('pembayaran') ?>"><i class="fa fa-circle-o"></i> Pembayaran Beban</a></li>
                                <li class="<?= $this->uri->segment(1) == 'pemb_modal' ? 'active': '' ?>"><a href="<?= site_url('pemb_modal') ?>"><i class="fa fa-circle-o"></i> Perubahan Modal</a></li>
                            <?php
                        } else {
                            ?>
                                <li class="<?= $this->uri->segment(1) == 'kebutuhan' ? 'active': '' ?>"><a href="<?= site_url('kebutuhan') ?>"><i class="fa fa-circle-o"></i> Hitung Keb. Pengadaan</a></li>
                                <li class="<?= $this->uri->segment(1) == 'pembelian' ? 'active': '' ?>"><a href="<?= site_url('pembelian') ?>"><i class="fa fa-circle-o"></i> Pembelian</a></li>
                                <li class="<?= $this->uri->segment(1) == 'penerimaan' ? 'active': '' ?>"><a href="<?= site_url('penerimaan') ?>"><i class="fa fa-circle-o"></i> Penerimaan Barang</a></li>
                            <?php
                        }
                    ?>
                </ul>
            </li>
            <li class="treeview <?= $this->uri->segment(1) == 'keuangan' ? 'active' : '' ?>">
                <a href="#">
                    <i class="fa fa-bar-chart"></i> <span>Laporan</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <?php
                        if($this->session->userdata('level') == 1) {
                            ?>
                                <li class="<?= $this->uri->segment(2) == 'lapPenj' ? 'active': '' ?>"><a href="<?= site_url('keuangan/lapPenj') ?>"><i class="fa fa-circle-o"></i> Laporan Penjualan</a></li>
                                <li class="<?= $this->uri->segment(2) == 'jurnal' ? 'active': '' ?>"><a href="<?= site_url('keuangan/jurnal') ?>"><i class="fa fa-circle-o"></i> Jurnal Umum</a></li>
                                <li class="<?= $this->uri->segment(2) == 'buku_besar' ? 'active': '' ?>"><a href="<?= site_url('keuangan/buku_besar') ?>"><i class="fa fa-circle-o"></i> Buku Besar</a></li>
                                <li class="<?= $this->uri->segment(2) == 'laba_rugi' ? 'active': '' ?>"><a href="<?= site_url('keuangan/laba_rugi') ?>"><i class="fa fa-circle-o"></i> Laporan Laba Rugi</a></li>
                                <li class="<?= $this->uri->segment(2) == 'perubahan_modal' ? 'active': '' ?>"><a href="<?= site_url('keuangan/perubahan_modal') ?>"><i class="fa fa-circle-o"></i> Laporan Perubahan Modal</a></li>
                            <?php
                        } else {
                            ?>
                                <li class="<?= $this->uri->segment(2) == 'pembelian' ? 'active': '' ?>"><a href="<?= site_url('keuangan/kartuStok') ?>"><i class="fa fa-circle-o"></i> Kartu Stok</a></li>
                                <li class="<?= $this->uri->segment(2) == 'lapPemb' ? 'active': '' ?>"><a href="<?= site_url('keuangan/lapPemb') ?>"><i class="fa fa-circle-o"></i> Laporan Pembelian</a></li>
                            <?php
                        }
                    ?>
                </ul>
            </li> 
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>