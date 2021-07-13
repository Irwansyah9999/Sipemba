<?php 
    include_once('../../engine/config/Loader.php');

    Loader::autoLoaderUnregister('../../engine/config',['Loader.php']);
    Loader::autoLoaderRegister('../../engine/model',['CekPoint.php']);

    $view = new View(true);
    $cekPoint = new CekPoint();

    if(isset($_GET['id'])){
        $kode = $view->get('id');
        
        if(!$cekPoint->removeData($kode,'string')->ready('execute')){
            $view->redirect('Cek-point/','Data dengan kode '.$kode.' berhasil dihapus');
        }
    }
?>