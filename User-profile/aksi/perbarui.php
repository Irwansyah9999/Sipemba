<?php
require_once('../../engine/config/Loader.php');

Loader::autoLoaderUnregister('../../engine/config',['Loader.php']);
Loader::autoLoaderRegister('../../engine/model',['Karyawan.php','Pengguna.php']);

$view = new View(true);

$view->accesSession(['karyawan','kb'],$view->getSession('akses'),1,true);

if(isset($_POST['perbarui'])){
    $kode = isset($_POST['kode'])?$_POST['kode']:'';
    $nama = isset($_POST['nama'])?$_POST['nama']:'';
    $tempat_lahir = isset($_POST['tempat_lahir'])?$_POST['tempat_lahir']:'';
    $tanggal_lahir = isset($_POST['tanggal_lahir'])?$_POST['tanggal_lahir']:'';
    $jenis_kelamin = isset($_POST['jenis_kelamin'])?$_POST['jenis_kelamin']:'';
    $email = isset($_POST['email'])?$_POST['email']:'';
    $no_telepon = isset($_POST['telepon'])?$_POST['telepon']:'';
    $alamat = isset($_POST['alamat'])?$_POST['alamat']:'';
    
    $password = isset($_POST['password'])?$_POST['password']:'';

    $data = array(
        'kode' => 'null',
        'nama' => 'null',
        'tempat_lahir' => 'null',
        'telepon' => 'null',
        'email' => 'null',
        'alamat' => 'null'
    );

    $view->validation($data);

    $penggunaDetail = new Karyawan();
    $penggunaDetail->fields = [$kode,$nama,$tempat_lahir,$tanggal_lahir,$jenis_kelamin,$email,$no_telepon,$alamat];

    if(!$penggunaDetail->updateData($kode,'string')->ready('execute')){
        
        $pengguna = new Pengguna();
        $pengguna->setField(['nama_pengguna','username','password']);

        $pengguna->fields = [$nama,$email,$password];
        
        if(!$pengguna->updateData($kode,'string')->ready('execute')){
            $view->redirect('User-profile/','Data berhasil diperbarui');
        }else{

        }
    }else{
        echo 'Data tidak berhasil ditambah'; 
    }


}else{
    
}
?>