<?php 
    include_once('../../engine/config/Loader.php');

    Loader::autoLoaderUnregister('../../engine/config',['Loader.php']);
    Loader::autoLoaderRegister('../../engine/model',['Karyawan.php','Pengguna.php']);

    $view = new View(true);
    $karyawan = new Karyawan();
    $pengguna = new Pengguna();

    if(isset($_GET['id'])){
        $nip = $view->get('id');
        
        if(!$karyawan->removeData($nip,'string')->ready('execute')){
            if(!$pengguna->removeData($nip,'string')->ready('execute')){
                $view->redirect('Karyawan/','Data dengan nip '.$nip.' berhasil dihapus');
            }
        }
    }
?>