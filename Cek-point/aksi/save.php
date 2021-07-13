<?php 
    include_once('../../engine/config/Loader.php');

    Loader::autoLoaderUnregister('../../engine/config',['Loader.php']);
    Loader::autoLoaderRegister('../../engine/model',['CekPoint.php']);

    $view = new View();
    $cekPoint = new CekPoint();

    if(isset($_POST['tambah'])){
        $tambah = $view->posts(['kode','provinsi','kabkot','tikpon']);

        $array = array(
            'kode' => 'null',
            'provinsi' => 'null',
            'kabkot' => 'null',
            'tikpon' => 'null'
        );

        $datacekPoint = $cekPoint->select($cekPoint->getTable())->where()->comparing('kode_cp',$tambah['kode'])->goData();

        // add field data
        foreach ($tambah as $key => $value) {
            $cekPoint->fields[] = $value;
        }

        if($datacekPoint != array()){
            $view->redirect('Cek-point/?kode='.$tambah['kode'],'Data dengan kode '.$tambah['kode'].' telah tersedia');
        }else{            
            if(!$cekPoint->saveData()->ready('execute')){
                $view->redirect('Cek-point/','Data dengan kode cp '.$tambah['kode_s'].' berhasil ditambahkan');
            }
        }
    }
?>