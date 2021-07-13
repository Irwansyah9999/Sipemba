<?php 
    include_once('../../engine/config/Loader.php');

    Loader::autoLoaderUnregister('../../engine/config',['Loader.php']);
    Loader::autoLoaderRegister('../../engine/model',['Pengiriman.php','PengirimanDetail.php']);

    $view = new View(true);
    $pengiriman = new Pengiriman();
    $pengirimanDetail = new PengirimanDetail();

    if(isset($_POST['perbarui'])){
        $perbarui = $view->posts(['kode','tanggal','status','provinsi','jenis','keterangan','nip']);

        $array = array(
            'status' => 'null',
            'provinsi' => 'null',
            'nip' => 'null',
            'keterangan' => 'null',
            'nip' => 'null'
        );

        $dataPengiriman = $pengiriman->select($pengiriman->getTable())->where()->comparing('kode_pengiriman',$perbarui['kode'])->goData();

        // add field data
        // 'kode_pengiriman','tanggal_detail','status_detail','cek_point','jenis_detail','keterangan','nip'
        $pengirimanDetail->fields = [$perbarui['kode'],$perbarui['tanggal'],$perbarui['status'],$perbarui['provinsi'],$perbarui['jenis'],$perbarui['keterangan'],$perbarui['nip']];

        // set ulang pengiriman
        $pengiriman->setField(['status_pengiriman']);
        $pengiriman->fields = [$perbarui['status']];
        
        if($dataPengiriman == array()){
            $view->redirect('pengiriman/?kode='.$perbarui['kode'],'Data dengan kode pengiriman '.$perbarui['kode'].' tidak tersedia');
        }else{
            if(!$pengirimanDetail->saveData()->ready('execute') && !$pengiriman->updateData($perbarui['kode'],'string')->ready('execute')){
                $view->redirect('Pengiriman/','Data dengan kode pengiriman '.$perbarui['kode'].' berhasil diperbarui dan ditambahkan detailnya');
            }
        }
    }
?>