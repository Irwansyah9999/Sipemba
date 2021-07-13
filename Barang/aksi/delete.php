<?php 
    include_once('../../engine/config/Loader.php');

    Loader::autoLoaderUnregister('../../engine/config',['Loader.php']);
    Loader::autoLoaderRegister('../../engine/model',['BarangDetail.php','Barang.php']);

    $view = new View(true);
    $barang = new Barang();
    $barangDetail = new BarangDetail();

    if(isset($_GET['id'])){
        $kode = $view->get('id');
        
        if(!$barang->removeData($kode,'string')->ready('execute')){
            if(!$barangDetail->removeData($kode,'string')->ready('execute')){
                $view->redirect('Barang/','Data dengan kode '.$kode.' berhasil dihapus');
            }
        }
    }
?>