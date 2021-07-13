<?php 
    include_once('../../engine/config/Loader.php');

    Loader::autoLoaderUnregister('../../engine/config',['Loader.php']);
    Loader::autoLoaderRegister('../../engine/model',['Pengiriman.php','Pengirim.php','Penerima.php','Barang.php','BarangDetail.php']);

    $view = new View(true);

    $pengiriman = new Pengiriman();
    $pengirim = new Pengirim();
    $penerima = new Penerima();
    $barang = new Barang();
    $barangDetail = new BarangDetail();

    if(isset($_POST['tambah'])){
        $tambahPengirim = $view->posts(['kode_p','nama_p','telepon_p','provinsi_p','kotkab_p','alamat_p']);
        $tambahPenerima = $view->posts(['kode_pe','nama_pe','telepon_pe','provinsi_pe','kotkab_pe','alamat_pe']);

        $tambahPengiriman = $view->posts(['kode','tanggal','status','harga']);

        $tambahBarang = $view->posts(['kode_barang','keterangan_barang','jumlah']);

        $tambahBarangDetail = array();

        for ($i=0; $i < $tambahBarang['jumlah']; $i++) { 
            $tambahBarangDetail[$i] = $view->posts(['nama_barang_'.$i,'status_barang_'.$i,'jenis_barang_'.$i,'massa_barang_'.$i,'jumlah_barang_'.$i]);
        }

        $array = array(
            
        );

        $view->validation($array);

        //$datapengiriman = $pengiriman->select($pengiriman->getTable())->where()->comparing('kode_pengiriman',$tambahPengiriman['kode'])->goData();

        // add field data pengirim
        $pengirim->fields = [$tambahPengirim['kode_p'],$tambahPengirim['nama_p'],$tambahPengirim['telepon_p'],$tambahPengirim['provinsi_p'].' '.$tambahPengirim['alamat_p']];

        // add field data penerima
        $penerima->fields = [$tambahPenerima['kode_pe'],$tambahPenerima['nama_pe'],$tambahPenerima['telepon_pe'],$tambahPenerima['provinsi_pe'].' '.$tambahPenerima['alamat_pe']];

        $pesan = '';
        if(!$pengirim->saveData()->ready('execute') && !$penerima->saveData()->ready('execute')){
            
            // add field data barang
            $barang->fields = [$tambahBarang['kode_barang'],$tambahBarang['keterangan_barang']];
            $barang->saveData()->ready('execute');

            $massa = 0;
            for ($i=0; $i < $tambahBarang['jumlah']; $i++) { 

                $massa += $tambahBarangDetail[$i]['massa_barang_'.$i];
                // add field data barang detail
                $barangDetail->fields = [$tambahBarang['kode_barang'],$tambahBarangDetail[$i]['nama_barang_'.$i],$tambahBarangDetail[$i]['status_barang_'.$i],$tambahBarangDetail[$i]['jenis_barang_'.$i],$tambahBarangDetail[$i]['jumlah_barang_'.$i],$tambahBarangDetail[$i]['massa_barang_'.$i]];

                $barangDetail->saveData()->ready('execute');
            }

            // add field data pengiriman tambahPengiriman = $view->posts(['kode','tanggal','status']);
            $pengiriman->fields = [$tambahPengiriman['kode'],$tambahPengiriman['tanggal'],$tambahPengiriman['status'],$massa,$tambahPengiriman['harga'],$tambahPengirim['kode_p'],$tambahPenerima['kode_pe'],$tambahBarang['kode_barang']];

            if(!$pengiriman->saveData()->ready('execute')){
                $view->redirect('Pengiriman/','Pengiriman Berhasil dilakukan');
            }
            
        }else{

        }

    }
?>