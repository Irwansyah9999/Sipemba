<?php 
    include_once('../../engine/config/Loader.php');

    Loader::autoLoaderUnregister('../../engine/config',['Loader.php']);
    Loader::autoLoaderRegister('../../engine/model',['Penerima.php']);

    $view = new View(true);
    $penerima = new Penerima();
    

    if(isset($_GET['id'])){
        $kode = $view->get('id');
        
        if(!$penerima->removeData($kode,'string')->ready('execute')){
            $view->redirect('Penerima/','Data dengan kode '.$kode.' berhasil dihapus');
        }
    }
?>