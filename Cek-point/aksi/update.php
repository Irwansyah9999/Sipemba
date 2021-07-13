<?php 
    include_once('../../engine/config/Loader.php');

    Loader::autoLoaderUnregister('../../engine/config',['Loader.php']);
    Loader::autoLoaderRegister('../../engine/model',['CekPoint.php']);

    $view = new View();
    $cekPoint = new CekPoint();

    if(isset($_POST['perbarui'])){
        $perbarui = $view->posts(['kode','provinsi','kabkot','tikpon']);

        $array = array(
            'kode' => 'null',
            'provinsi' => 'null',
            'kabkot' => 'null',
            'tikpon' => 'null'
        );

        $datacekPoint = $cekPoint->select($cekPoint->getTable())->where()->comparing('kode_cp',$perbarui['kode'])->goData();

        // add field data
        foreach ($perbarui as $key => $value) {
            $cekPoint->fields[] = $value;
        }

        if($datacekPoint == array()){
            $view->redirect('Cek-point/?kode='.$perbarui['kode'],'Data dengan kode '.$perbarui['kode'].' tidak tersedia');
        }else{            
            if(!$cekPoint->updateData($perbarui['kode'],'string')->ready('execute')){
                $view->redirect('Cek-point/','Data dengan nip '.$perbarui['kode_s'].' berhasil diperbaruikan');
            }
        }
    }
?>