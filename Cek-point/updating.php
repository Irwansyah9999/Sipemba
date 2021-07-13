<?php 
$id = $view->get('id');
$dataPoint = $cekPoint->select($cekPoint->getTable())->where()->comparing('kode_cp',$id)->goData();
?>
<!-- Box update cekPoint  -->
<div class="box-lg bd-shadow" id="pb">
    <div class="header">
        PERBARUI CEK POINT DENGAN KODE <?= $id ?>

        <div class="float-right">
            <button type="button" class="btn-lg btn-danger" onclick="onLocation('?action')">X</button>
        </div><div class="clear-right"></div>
    </div>
    <div class="body">
        <form action="aksi/update.php" method="post">
            <!-- cekPoint -->

            <input type="text" name="kode" id="" class="form-control" placeholder="Kode" value="<?= $id ?>" readonly>

            <input type="text" name="provinsi" class="form-control" placeholder="Provinsi" value="<?= $dataPoint[0]['provinsi'] ?>">
            
            <input type="text" name="kabkot" id="" class="form-control" placeholder="Kab/Kota" value="<?= $dataPoint[0]['kab_kota'] ?>">

            <input type="text" name="tikpon" id="" class="form-control" placeholder="Titik Point" value="<?= $dataPoint[0]['titik_point'] ?>">

            <button type="submit" class="btn btn-safe" name="perbarui">PERBARUI</button>
        </form>
    </div>
</div>
<!-- end  -->        