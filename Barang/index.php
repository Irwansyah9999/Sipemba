<?php
    include_once('../engine/config/Loader.php');

    Loader::autoLoaderUnregister('../engine/config',['Loader.php']);
    Loader::autoLoaderRegister('../engine/model',['Barang.php','BarangDetail.php']);

    $view = new View(true);
    $barang = new Barang();
    $barangDetail = new BarangDetail();

    if($view->getSession('akses') == null){
        $view->redirect('');
    }

    $view->accesSession(['kb'],$view->getSession('akses'),1);

    $head = 'SiPEMBA';

    $view->setHeading("$head | Barang");

    // atribut
    $atribut = $view->gets(['action' => '','page' => 1,'maxLength' => 5,'log' => '../']);

    $url = http_build_query($_GET);

    $field = ['Kode','keterangan'];

    $fieldDetail = ['Kode','nama','status','jenis','jumlah','massa'];

    // pencarian
    $tipe = $view->get('tipe');
    $pencarian = array('kode_barang' => $view->get('kode'));

    $pencarianDetail = array('nama_barang' => $view->get('nama'),'status_barang' => $view->get('status'),'jenis_barang' => $view->get('jenis'),
    'jumlah_barang' => $view->get('jumlah'),'massa_barang' => $view->get('massa'));

    // brum
    $view->list = ['head' => 'Pengelolaan Barang','list' => 'Home > Barang'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('../engine/include/heading.php') ?>
</head>
<body>
    <div class="container">
        <!-- heading, heading right and navigation -->
        
        <div class="row btn-safe">
            <!-- navigation -->
            <?php include_once('../engine/include/navigation-top.php') ?>

        </div>

        <!-- brum -->
        <?php include_once('../engine/include/brum.php') ?>

        <!-- content and side -->
        <div class="row">
            <!-- content -->
            <div class="offset-5pc col-60pc float-left">

                <?php 
                if($atribut['action'] == ''){
                ?>
                <!-- Box Data BARANG -->
                <div class="box-lg bd-shadow bd-radius-5px">
                    <div class="header">
                        DATA BARANG 
                            <button type="button" class="btn btn-safe" onclick="onLocation('?action=paper&#rk')">Rekap</button>
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
                        <?php include('../engine/include/notif.php') ?>

                        <div class="table-responsive">
                            <table class="table max-width">
                                <thead>
                                    <th>No</th>
                            <?php 
                                foreach ($field as $key => $value) { ?>
                                    <th><?= $value ?></th>    
                            <?php 
                                }
                            ?>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                            <?php 
                                $data = ($tipe == '')?$barang->select($barang->getTable(),['count(*)'])->go():
								$barang->select($barang->getTable(),['count(*)'])->where()->manySearchCharacter($pencarian,$tipe)->go();
								
                                $paging = $view->paging($atribut['page'],$atribut['maxLength'],$data[0][0]);

                                // set
                                ($tipe == '')?$barang->select($barang->getTable())->limit($paging['firstOfValue'],$paging['sumOfData'])->ready():
								$barang->select($barang->getTable())->where()->manySearchCharacter($pencarian,$tipe)->limit($paging['firstOfValue'],$paging['sumOfData'])->ready();

                                if($barang->getStatement()->rowCount()){
                                    while($row = $barang->getStatement()->fetch()) { ?>
                                        <tr>
                                           <td><?= $paging['noOfData']++ ?></td> 
                                        <?php 
                                        // cetak data
                                        for ($i=0; $i < count($field); $i++) { ?>
                                            <td><?= $row[$i] ?></td>  
                                        <?php
                                        }
                                        ?>
                                            <td><button type="button" class="btn btn-warning" name="detail" onclick="onLocation('?action=detail&id=<?= $row['kode_barang'] ?>&#pb')">detail</button></td>
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
                <!-- end Box Data BARANG -->

                <?php 
                    }else if($atribut['action'] == 'detail'){
                        include_once('detail.php');
                    }else if($atribut['action'] == 'paper'){
                        include_once('paper.php');
                    }else if($atribut['action'] == 'paper-detail'){
                        include_once('paper-detail.php');
                    }
                ?>

            </div>
            <!-- end content -->

            <!-- side -->
            <div class="col-25pc float-right">

                <?php include_once('../engine/include/navigation-side.php') ?>
                
            </div>
            
            <div class="clear-both"></div>
        </div>

        <?php include_once('../engine/include/footer.php') ?>

        <script src="<?= $view->url('engine/js/cb.js') ?>"></script>
        <script src="<?= $view->url('engine/js/anythink.js') ?>"></script>
    </div>
</body>
</html>