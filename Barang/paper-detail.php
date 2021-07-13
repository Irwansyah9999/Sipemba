<?php
    $id = $view->get('id');
?>

<!-- Box Rekap BARANG -->
<div class="box-lg bd-shadow bd-radius-5px" id="rk">
    <div class="header">
        REKAP BARANG BERDASARKAN KODE <?= $id ?>

        <div class="float-right">
            <button type="button" class="btn-lg btn-danger" onclick="onLocation('?action')">X</button>
        </div><div class="clear-right"></div>

        <!-- pencarian dan tampil data -->
        <div class="row-mg">
            <form action="" method="get">
                <label>TANGGAL AWAL</label>
                <input type="date" name="tanggal_awal" id="" class="form-control-nl">

                <label>TANGGAL AKHIR</label>
                <input type="date" name="tanggal_akhir" id="" class="form-control-nl">

                <button type="submit" class="btn btn-safe">Rekap</button>
            </form>
        </div>

        <button type="button" class="btn btn-safe" onclick="printElement('cetak')">Cetak</button>
    </div>
    <div class="body" id="cetak">
        <div class="row-mg">
            
            <img src="<?= $view->url('engine/img/Pengiriman 1.jpg') ?>" alt="" srcset="" width="100%">
            
            <div class="row-mg">
                <?php include_once('../engine/include/paper-head.php') ?>
            </div>
        </div>
        <!-- end pencarian dan tampil data -->
        <div class="row-mg table-responsive">
            <table class="table max-width">
                <thead>
                    <th>No</th>
            <?php 
                foreach ($fieldDetail as $key => $value) { ?>
                    <th><?= $value ?></th>    
            <?php 
                }
            ?>
                </thead>
                <tbody>
            <?php 
                $no = 1;
                $barangDetail->select($barangDetail->getTable())->where()->comparing('kode_barang',$id)->ready();

                if($barangDetail->getStatement()->rowCount()){
                    while($row = $barangDetail->getStatement()->fetch()) { ?>
                        <tr>
                            <td><?= $no++ ?></td> 
                        <?php 
                        // cetak data
                        for ($i=0; $i < count($fieldDetail); $i++) { ?>
                            <td><?= $row[$i] ?></td>  
                        <?php
                        }
                        ?>
                        </tr>
                    <?php
                    }
                }else{ ?>
                    <td>Data Tidak tersedia</td>
            <?php 
                }
            ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="footer">
        
    </div>
</div>
<!-- end Box rekap Data -->