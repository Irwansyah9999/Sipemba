<?php
    $id = $view->get('id');
?>

<!-- Box Data Detail BARANG -->
<div class="box-lg bd-shadow bd-radius-5px">
    <div class="header">
        DATA DETAIL BARANG BERDASARKAN KODE <?= $id ?>
            <button type="button" class="btn btn-safe" onclick="onLocation('?action=paper-detail&id=<?= $id ?>')">Rekap</button>

            <div class="float-right">
            <button type="button" class="btn-lg btn-danger" onclick="onLocation('?action')">X</button>
        </div><div class="clear-right"></div>
        
    </div>
    <div class="body">
        <!-- pencarian dan tampil data -->
        <div class="row-mg">
            <div class="row">
                <div class="float-left">
                    <?php include('../engine/include/maksimum-data.php') ?>
                </div>
                <div class="float-right">
                    <button type="button" class="btn btn-safe" id="btn-cari">PENCARIAN</button>
                </div>

                <div class="clear-both"></div>
            </div>

            <?php include_once('searching.php') ?>
        </div>

        <!-- end pencarian dan tampil data -->
        <div class="table-responsive">
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
                $data = ($tipe == '')?$barangDetail->select($barangDetail->getTable(),['count(*)'])->where()->comparing('kode_barang',$id)->go():
                $barangDetail->select($barangDetail->getTable(),['count(*)'])->where()->manySearchCharacter($pencarianDetail,$tipe)->and()->comparing('kode_barang',$id)->go();
                
                $paging = $view->paging($atribut['page'],$atribut['maxLength'],$data[0][0]);

                // set
                ($tipe == '')?$barangDetail->select($barangDetail->getTable())->where()->comparing('kode_barang',$id)->limit($paging['firstOfValue'],$paging['sumOfData'])->ready():
                $barangDetail->select($barangDetail->getTable())->where()->manySearchCharacter($pencarianDetail,$tipe)->and()->comparing('kode_barang',$id)->limit($paging['firstOfValue'],$paging['sumOfData'])->ready();

                if($barangDetail->getStatement()->rowCount()){
                    while($row = $barangDetail->getStatement()->fetch()) { ?>
                        <tr>
                            <td><?= $paging['noOfData']++ ?></td> 
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
        </div><br>
        <?php include_once('../engine/include/paging.php') ?>
    </div>
    <div class="footer">
        Total Data <?= $data[0][0] ?>
    </div>
</div>
<!-- end -->