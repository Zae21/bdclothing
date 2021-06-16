<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Penerimaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        if(!$this->session->userdata("username")) redirect("login");

        $this->load->model('Pembelian_model');
        $this->load->model('Pemasok_model');
        $this->load->model('Bahan_baku_model');
        $this->load->model('Kebutuhan_model');
        $this->load->model('Penerimaan_model');
        $this->load->model('Keuangan_model');
    }
    private $idpg;
    function index()
    {
        $data['dataPenerimaan'] = $this->Penerimaan_model->read("status = 2");
        $data['view'] = "penerimaan/index";
        $this->load->view('index', $data);
    }

    function create()
    {
        $id = $this->Penerimaan_model->kode_penerimaan();
        $idPesanan = $this->input->get('pengadaan_id', TRUE);
        if($idPesanan) {
            $data['dataDetailPengadaan'] = $this->Kebutuhan_model->readDetailKebutuhan($idPesanan);
            $data['pengadaan'] = $this->Kebutuhan_model->read("id_transaksi = '$idPesanan'")[0];
            $data['dataKebutuhan'] = $this->Kebutuhan_model->hitungKebutuhanBeli($idPesanan);

        } else {
            $data['dataDetailPengadaan'] = null;
            $data['pengadaan'] = null;
            $data['dataKebutuhan'] = null;
        }

        $data['dataPengadaan'] = $this->Kebutuhan_model->readPengadaan("pengadaan_barang.status = 2");
        $data['view'] = "penerimaan/create";
        $data['kode_penerimaan'] = $id;
        $data['dataDetail'] = $this->Penerimaan_model->readDetailPenerimaan($id);
        $data['dataBahanBaku'] = $this->Bahan_baku_model->read();
        $data['dataPemasok'] = $this->Pemasok_model->read();
        $this->load->view('index', $data);

    }

    function store()
    {
        $total = 0;
        for($i = 0; $i < count($this->input->post('id_barang')); $i++) {
            $id_penerimaan = $this->input->post('id_penerimaan')[$i];
                $dataStore = array(
                    'id_penerimaan' => $this->input->post('id_penerimaan')[$i],
                    'id_barang' => $this->input->post('id_barang')[$i],
                    'qty' => $this->input->post('qty')[$i],
                    'biaya_bahan_baku' => $this->input->post('biaya_bahan_baku')[$i],
                    'biaya_produksi' => $this->input->post('biaya_produksi')[$i],
                    'biaya_tambahan' => $this->input->post('biaya_tambahan')[$i],
                );
                $total = $total+($this->input->post('biaya_bahan_baku')[$i] + $this->input->post('biaya_produksi')[$i] + $this->input->post('biaya_tambahan')[$i]);
                $harga_satu[$i] = ($this->input->post('biaya_bahan_baku')[$i] + $this->input->post('biaya_produksi')[$i] + $this->input->post('biaya_tambahan')[$i])/$this->input->post('qty')[$i];
                
                $this->Penerimaan_model->createDetail($dataStore);


                $qty_beli[$i] = $this->input->post('qty')[$i];
                // $saldoStok[$i] = $this->Keuangan_model->getStokLast($this->input->post('id_barang')[$i])->jml_saldo;
                // $hpp_awal[$i] = $this->Keuangan_model->getStokLast($this->input->post('id_barang')[$i])->harga_saldo;
                // $hpp_akhir[$i] = ((($qty_beli[$i]*$harga_satu[$i])+($saldoStok[$i]*$hpp_awal[$i]))/($qty_beli[$i]+$saldoStok[$i]));


                $this->db->where('id_barang',$this->input->post('id_barang')[$i])
                        ->order_by('id','DESC')
                       ->limit(1);
                $query = $this->db->get('logsaldo');
                if($query->num_rows() == 0){
                    $dataStok = array('keterangan' => 'Pembelian' ,
                                        'id_barang' => $this->input->post('id_barang')[$i],
                                        'jml_masuk' => $this->input->post('qty')[$i],
                                        'harga'     => $harga_satu[$i],
                                        'jml_keluar' => 0,
                                        'hpp' => 0,
                                        'jml_saldo' => $this->input->post('qty')[$i],
                                        'harga_saldo' => $harga_satu[$i],
                                        'tanggal' => date('Y-m-d'),
                                        'id_transaksi' => $this->input->post('id_penerimaan')[$i]
                                    );
                    $this->db->insert('kartu_stok',$dataStok);
                    $dataSaldo = array('jml_saldo' => $this->input->post('qty')[$i],
                                        'hrg_saldo' => $harga_satu[$i],
                                        'id_barang' => $this->input->post('id_barang')[$i]
                                    );
                    $this->db->insert('logsaldo',$dataSaldo);
                }else{
                    if ($query->row()->hrg_saldo == $harga_satu[$i]) {
                        $this->db->where(array('id' => $query->row()->id));
                        $this->db->set('jml_saldo','jml_saldo+'.$qty_beli[$i]."",FALSE);
                        $this->db->update('logsaldo');


                        $this->db->where(array('id_barang'=>$this->input->post('id_barang')[$i], 'jml_saldo >'=>0 ))
                                ->order_by('id','ASC')
                               ->limit(1);
                        $saldo[$i] = $this->db->get('logsaldo')->row();
                        $dataStok = array('keterangan' => 'Pembelian' ,
                                            'id_barang' => $this->input->post('id_barang')[$i],
                                            'jml_masuk' => $this->input->post('qty')[$i],
                                            'harga'     => $harga_satu[$i],
                                            'jml_keluar' => 0,
                                            'hpp' => 0,
                                            'jml_saldo' => $saldo[$i]->jml_saldo,
                                            'harga_saldo' => $saldo[$i]->hrg_saldo,
                                            'tanggal' => date('Y-m-d'),
                                            'id_transaksi' => $this->input->post('id_penerimaan')[$i]
                                        );
                        $this->db->insert('kartu_stok',$dataStok);

                        $this->db->where(array('id !='=>$saldo[$i]->id,'id_barang'=>$this->input->post('id_barang')[$i], 'jml_saldo >'=>0 ));
                        $kartu[$i] = $this->db->get('logsaldo')->result_array();
                        foreach ($kartu[$i] as $b[$i]) {
                            $datakartu = array('keterangan' => 'Saldo Stok' ,
                                                'id_barang' => $this->input->post('id_barang')[$i],
                                                'jml_masuk' => 0,
                                                'harga'     => 0,
                                                'jml_keluar' => 0,
                                                'hpp' => 0,
                                                'jml_saldo' => $b[$i]['jml_saldo'],
                                                'harga_saldo' => $b[$i]['hrg_saldo'],
                                                'tanggal' => date('Y-m-d'),
                                                'id_transaksi' => $this->input->post('id_penerimaan')[$i]
                                            );
                            $this->db->insert('kartu_stok',$datakartu);

                        }

                    }else{
                        $dataSaldo = array('jml_saldo' => $this->input->post('qty')[$i],
                                        'hrg_saldo' => $harga_satu[$i],
                                        'id_barang' => $this->input->post('id_barang')[$i]
                                    );
                        $this->db->insert('logsaldo',$dataSaldo);


                        $this->db->where(array('id_barang'=>$this->input->post('id_barang')[$i], 'jml_saldo >'=>0 ))
                                ->order_by('id','ASC')
                               ->limit(1);
                        $saldo[$i] = $this->db->get('logsaldo')->row();
                        $dataStok = array('keterangan' => 'Pembelian' ,
                                            'id_barang' => $this->input->post('id_barang')[$i],
                                            'jml_masuk' => $this->input->post('qty')[$i],
                                            'harga'     => $harga_satu[$i],
                                            'jml_keluar' => 0,
                                            'hpp' => 0,
                                            'jml_saldo' => $saldo[$i]->jml_saldo,
                                            'harga_saldo' => $saldo[$i]->hrg_saldo,
                                            'tanggal' => date('Y-m-d'),
                                            'id_transaksi' => $this->input->post('id_penerimaan')[$i]
                                        );
                        $this->db->insert('kartu_stok',$dataStok);

                        $this->db->where(array('id !='=>$saldo[$i]->id,'id_barang'=>$this->input->post('id_barang')[$i], 'jml_saldo >'=>0 ));
                        $kartu[$i] = $this->db->get('logsaldo')->result_array();
                        foreach ($kartu[$i] as $b[$i]) {
                            $datakartu = array('keterangan' => 'Saldo Stok' ,
                                                'id_barang' => $this->input->post('id_barang')[$i],
                                                'jml_masuk' => 0,
                                                'harga'     => 0,
                                                'jml_keluar' => 0,
                                                'hpp' => 0,
                                                'jml_saldo' => $b[$i]['jml_saldo'],
                                                'harga_saldo' => $b[$i]['hrg_saldo'],
                                                'tanggal' => date('Y-m-d'),
                                                'id_transaksi' => $this->input->post('id_penerimaan')[$i]
                                            );
                            $this->db->insert('kartu_stok',$datakartu);

                        }
                    }
                }


            }
            $datas = array('id_pengadaan' => $this->input->post('id_pengadaan'),
                            'tanggal_transaksi' => date('Y-m-d'),
                            'total' => $total,
                            'status'=>2);
            $this->db->where('id_penerimaan',$id_penerimaan)
                    ->set($datas)
                    ->update('penerimaan');

            $this->db->where('id_transaksi',$this->input->post('id_pengadaan'))
                    ->set("status",3)
                    ->update('pengadaan_barang');

        redirect('penerimaan');
        
    }

    function edit($id)
    {
        $result = $this->Pembelian_model->read("id = '$id'");
        $data['pembelian'] = $result[0];
        $data['view'] = "pembelian/edit";
        $this->load->view('index', $data);
    }

    function show($id) 
    {
        $data['dataDetail'] = $this->Penerimaan_model->readDetailPenerimaan($id);
        $data['penerimaan'] = $this->Penerimaan_model->read("id_penerimaan = '$id'")[0];
        $data['view'] = "penerimaan/show";
        $this->load->view('index', $data);
    }
    function update($id)
    {
        $dataStore = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'nomor_telepon' => $this->input->post('nomor_telepon')
        );

        $this->Pembelian_model->update("id = '$id'", $dataStore);
        return redirect('pembelian');
    }

    function deleteitem($id)
    {
        $this->db->from('detail_pembelian');
        $this->db->where("id = '$id'");
        $this->db->delete();

        redirect('pembelian/create');
    }

    function simpanbarang()
    {
        $this->Pembelian_model->InsertDetail();
        redirect('pembelian/create');
    }

    function pembelianselesai($idpg)
    {
        

		$this->Pembelian_model->selesaiPembelian($id, $this->input->post('pemasok_id'),$idpg);
        $save = array('status'=>3);
        $this->db->where('id', $id);
        $this->db->update('pembelian',$save);

        $save = array('status'=>2);
        $this->db->where('id_transaksi', $idpg);
        $this->db->update('pengadaan_barang',$save);


        $nominal = $this->Pembelian_model->getTotalTransaksi($id);
        // $this->Keuangan_model->generateJurnal('112', $id, 'debet', $nominal);
        // $this->Keuangan_model->generateJurnal('111', $id, 'kredit', $nominal);
	
		redirect('pembelian');
    }

    function updatestatus($id)
    {
        $this->Pembelian_model->update("id = '$id'", array('status' => 4));
        redirect('pembelian');
    }
}

?>