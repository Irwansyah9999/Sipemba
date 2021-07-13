<?php 
    include_once('../../engine/config/Loader.php');

    Loader::autoLoaderUnregister('../../engine/config',['Loader.php']);
    Loader::autoLoaderRegister('../../engine/model',['Karyawan.php','Pengguna.php']);

    $view = new View(true);
    $karyawan = new Karyawan();
    $pengguna = new Pengguna();

    if(isset($_POST['perbarui'])){
        $perbarui = $view->posts(['kode_p','nama_p','tempat_lahir_p','tanggal_lahir_p','jenis_kelamin_p','divisi_p','jabatan_p','email_p','telepon_p','alamat_p']);

        $array = array(
            'kode_p' => 'null',
            'nama_p' => 'null',
            'tempat_lahir_p' => 'null',
            'tanggal_lahir_p' => 'null',
            'jenis_kelamin_p' => 'null',
            'divisi_p' => 'null',
            'jabatan_p' => 'null',
            'email_p' => 'null',
            'telepon_p' => 'null',
            'alamat_p' => 'null'
        );

        $dataKaryawan = $karyawan->select($karyawan->getTable())->where()->comparing('nip',$perbarui['kode_p'])->goData();
        $dataPengguna = $pengguna->select($pengguna->getTable())->where()->comparing('kode_pengguna',$perbarui['kode_p'])->goData();

        // add field data
        foreach ($perbarui as $key => $value) {
            $karyawan->fields[] = $value;
        }

        if($dataKaryawan == array()){
            $view->redirect('Karyawan/kode_p='.$perbarui['kode_p'],'Data dengan nip '.$perbarui['kode_p'].' telah ada');
        }else{
            if(!$karyawan->updateData($perbarui['kode_p'],'string')->ready('execute')){

                $pengguna->fields = [$perbarui['kode_p'],$perbarui['nama_p'],$perbarui['email_p'],$dataPengguna[0]['password'],$perbarui['jabatan_p'],$dataPengguna[0]['akses_pembuatan']];
                if(!$pengguna->updateData($perbarui['kode_p'],'string')->ready('execute')){
                    $view->redirect('Karyawan/','Data dengan nip '.$perbarui['kode_p'].' berhasil diperbarui');
                }
            }
        }
    }
?>