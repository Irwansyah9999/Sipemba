<?php 
    include_once('../../engine/config/Loader.php');

    Loader::autoLoaderUnregister('../../engine/config',['Loader.php']);
    Loader::autoLoaderRegister('../../engine/model',['Karyawan.php','Pengguna.php']);

    $view = new View(true);
    $karyawan = new Karyawan();
    $pengguna = new Pengguna();

    if(isset($_POST['tambah'])){
        $tambah = $view->posts(['kode','nama','tempat_lahir','tanggal_lahir','jenis_kelamin','divisi','jabatan','email','telepon','alamat']);

        $array = array(
            'kode' => 'null',
            'nama' => 'null',
            'tempat_lahir' => 'null',
            'tanggal_lahir' => 'null',
            'jenis_kelamin' => 'null',
            'divisi' => 'null',
            'jabatan' => 'null',
            'email' => 'null',
            'telepon' => 'null',
            'alamat' => 'null'
        );

        $dataKaryawan = $karyawan->select($karyawan->getTable())->where()->comparing('nip',$tambah['kode'])->goData();
        $dataPengguna = $pengguna->select($pengguna->getTable())->where()->comparing('kode_pengguna',$tambah['kode'])->goData();

        // add field data
        foreach ($tambah as $key => $value) {
            $karyawan->fields[] = $value;
        }

        if($dataKaryawan != array()){
            $view->redirect('Karyawan/?kode_p='.$tambah['kode'],'Data dengan nip '.$tambah['kode'].' telah tersedia');
        }else{
            if(!$karyawan->saveData()->ready('execute')){
                $password = str_replace('-','',$tambah['tanggal_lahir']);

                $pengguna->fields = [$tambah['kode'],$tambah['nama'],$tambah['email'],$password,$tambah['jabatan'],date('Y-m-d H:i:s')];
                if(!$pengguna->saveData()->ready('execute')){
                    $view->redirect('Karyawan/','Data dengan nip '.$tambah['kode'].' berhasil ditambah');
                }
            }
        }
    }
?>