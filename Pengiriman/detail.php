<?php
    $id = $view->get('id');
?>

<!-- Box Data Detail pengiriman -->
<div class="box-lg bd-shadow bd-radius-5px">
    <div class="header">
        DATA DETAIL PENGIRIMAN BERDASARKAN KODE <?= $id ?>
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
                    <?php include_once('../engine/include/maksimum-data.php') ?>
                </div>
                <div class="float-right">
                    <button type="button" class="btn btn-safe" id="btn-cari">PENCARIAN</button>
                </div><div class="clear-both"></div>

                <?php include_once('searching.php') ?>
            </div>
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
                $data = ($tipe == '')?$pengirimanDetail->select($pengirimanDetail->getTable(),['count(*)'])->where()->comparing('kode_pengiriman',$id)->go():
                $pengiriman->select($pengirimanDetail->getTable(),['count(*)'])->where()->manySearchCharacter($pencarian,$tipe)->and()->comparing('kode_pengiriman',$id)->go();
                
                $paging = $view->paging($atribut['page'],$atribut['maxLength'],$data[0][0]);

                // set
                ($tipe == '')?$pengirimanDetail->select($pengirimanDetail->getTable())->where()->comparing('kode_pengiriman',$id)->limit($paging['firstOfValue'],$paging['sumOfData'])->ready():
                $pengirimanDetail->select($pengirimanDetail->getTable())->where()->manySearchCharacter($pencarian,$tipe)->and()->comparing('kode_pengiriman',$id)->limit($paging['firstOfValue'],$paging['sumOfData'])->ready();

                if($pengirimanDetail->getStatement()->rowCount()){
                    while($row = $pengirimanDetail->getStatement()->fetch()) { ?>
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