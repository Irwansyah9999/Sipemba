<?php
    include_once('../engine/config/Loader.php');

    Loader::autoLoaderUnregister('../engine/config',['Loader.php']);
    Loader::autoLoaderRegister('../engine/model',['Penerima.php']);

    $view = new View(true);
    $penerima = new Penerima();

    if($view->getSession('akses') == null){
        $view->redirect('');
    }

    $view->accesSession(['kb'],$view->getSession('akses'),1,'',true);

    $head = 'SiPEMBA';

    $view->setHeading("$head | Penerima");

    // atribut
    $atribut = $view->gets(['action' => '','page' => 1,'maxLength' => 5,'log' => '../']);

    $url = http_build_query($_GET);

    $field = ['Kode','nama','telepon','alamat'];

    // pencarian
    $tipe = $view->get('tipe');
    $pencarian = array('kode_penerima' => $view->get('kode_pe'),'nama_penerima' => $view->get('nama_pe'),'telepon_penerima' => $view->get('telepon_pe'),'alamat_penerima' => $view->get('alamat_pe'));

    // brum
    $view->list = ['head' => 'Pengelolaan Penerima','list' => 'Home > Penerima'];

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
                <!-- Box Data penerima -->
                <div class="box-lg bd-shadow bd-radius-5px">
                    <div class="header">
                        DATA PENERIMA 
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
                                </thead>
                                <tbody>
                            <?php 
                                $data = ($tipe == '')?$penerima->select($penerima->getTable(),['count(*)'])->go():
								$penerima->select($penerima->getTable(),['count(*)'])->where()->manySearchCharacter($pencarian,$tipe)->go();
								
                                $paging = $view->paging($atribut['page'],$atribut['maxLength'],$data[0][0]);

                                // set
                                ($tipe == '')?$penerima->select($penerima->getTable())->limit($paging['firstOfValue'],$paging['sumOfData'])->ready():
								$penerima->select($penerima->getTable())->where()->manySearchCharacter($pencarian,$tipe)->limit($paging['firstOfValue'],$paging['sumOfData'])->ready();

                                if($penerima->getStatement()->rowCount()){
                                    while($row = $penerima->getStatement()->fetch()) { ?>
                                        <tr>
                                           <td><?= $paging['noOfData']++ ?></td> 
                                        <?php 
                                        // cetak data
                                        for ($i=0; $i < count($field); $i++) { ?>
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
                <!-- end Box Data penerima -->

                <?php 
                    }else if($atribut['action'] == 'paper'){
                        include_once('paper.php');
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