<?php 
    include_once('../../engine/config/Loader.php');

    Loader::autoLoaderUnregister('../../engine/config',['Loader.php']);
    Loader::autoLoaderRegister('../../engine/model',['Pengiriman.php','Barang.php','BarangDetail.php','Pengirim.php','Penerima.php']);

    $view = new View(true);
    $pengiriman = new Pengiriman();

    $penerima = new Penerima();
    $pengirim = new Pengirim();
    $barang = new Barang();
    $barangDetail = new BarangDetail(); 

    if(isset($_GET['id'])){
        $kode = $view->get('id');
        
        $datapengiriman = $pengiriman->select($pengiriman->getTable())->where()->comparing('kode_pengiriman',$kode)->go();

        if(!$pengiriman->removeData($kode,'string')->ready('execute')){
            if(!$penerima->removeData($datapengiriman[0]['kode_penerima'],'string')->ready() && !$pengirim->removeData($datapengiriman[0]['kode_pengirim'],'string')->ready()){
                if(!$barang->removeData($datapengiriman[0]['kode_barang'],'string')->ready('execute') && !$barangDetail->removeData($datapengiriman[0]['kode_barang'],'string')->ready()){
                    $view->redirect('Pengiriman/','Data dengan kode '.$kode.' berhasil dihapus');
                }
            }
        }
        
    }
?>