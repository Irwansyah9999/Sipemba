<?php 
    include_once('../engine/config/Loader.php');

    Loader::autoLoaderUnregister('../engine/config',['Loader.php']);
    Loader::autoLoaderRegister('../engine/model',['Karyawan.php','Pengguna.php']);

    $view = new View(true);
    $karyawan = new Karyawan();
    $pengguna = new Pengguna();

    if(isset($_POST['login'])){
        $login = $view->posts(['username','password','akses']);

        $array = array(
            'username' => 'null',
            'password' => 'null'
        );

        $tipe = array('nip' => 'kode_pengguna');

        if($login['akses'] == 'on'){
            foreach ($tipe as $key => $value) {
                // periksa user
                $dataKaryawan = $karyawan->select($karyawan->getTable())->where()->comparing($key,$login['username'])->go();
    
                if($dataKaryawan != array()){
                    $dataPengguna = $pengguna->select($pengguna->getTable())->where()->comparing($value,$login['username'])->go();
    
                    if($dataPengguna[0]['password'] == $login['password']){
                        $_SESSION['id'] = $dataPengguna[0]['kode_pengguna'];
                        $_SESSION['nama'] = $dataPengguna[0]['nama_pengguna'];
                        $_SESSION['akses'] = $dataPengguna[0]['akses_pengguna'];

                        $view->redirect('');
                    }else{
                        $view->back('Username dan Password tidak tersedia');
                    }
                }
            }
        }else{
            $view->back('Ceklis setuju dahulu untuk masuk');
        }
    }else{
        echo "tes";
    }
?>