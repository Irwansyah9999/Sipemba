<?php 
    include_once('../../engine/config/Loader.php');

    Loader::autoLoaderUnregister('../../engine/config',['Loader.php']);
    Loader::autoLoaderRegister('../../engine/model',['Pengirim.php']);

    $view = new View(true);
    $pengirim = new Pengirim();

    if(isset($_GET['id'])){
        $kode = $view->get('id');
        
        if(!$pengirim->removeData($kode,'string')->ready('execute')){
            $view->redirect('Pengirim/','Data dengan kode '.$kode.' berhasil dihapus');
        }
    }
?>