<?php
    include_once('../engine/config/Loader.php');

    Loader::autoLoaderUnregister('../engine/config',['Loader.php']);
    Loader::autoLoaderRegister('../engine/model',['Pengirim.php']);

    $view = new View(true);
    $pengirim = new Pengirim();

    if($view->getSession('akses') == null){
        $view->redirect('');
    }

    $view->accesSession(['kb'],$view->getSession('akses'),1,'',true);

    $head = 'SiPEMBA';

    $view->setHeading("$head | Pengirim");

    // atribut
    $atribut = $view->gets(['action' => '','page' => 1,'maxLength' => 5,'log' => '../']);

    $field = ['Kode','nama','telepon','alamat'];

    // pencarian
    $tipe = $view->get('tipe');
    $pencarian = array('kode_pengirim' => $view->get('kode_pe'),'nama_pengirim' => $view->get('nama_pe'),'telepon_pengirim' => $view->get('telepon_pe'),'alamat_pengirim' => $view->get('alamat_pe'));

    // brum
    $view->list = ['head' => 'Pengelolaan Pengirim','list' => 'Home > Pengirim'];

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
                <!-- Box Data pengirim -->
                <div class="box-lg bd-shadow bd-radius-5px">
                    <div class="header">
                        DATA PENGIRIM 
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
                                $data = ($tipe == '')?$pengirim->select($pengirim->getTable(),['count(*)'])->go():
								$pengirim->select($pengirim->getTable(),['count(*)'])->where()->manySearchCharacter($pencarian,$tipe)->go();
								
                                $paging = $view->paging($atribut['page'],5,count($data));

                                // set
                                ($tipe == '')?$pengirim->select($pengirim->getTable())->limit($paging['firstOfValue'],$paging['sumOfData'])->ready():
								$pengirim->select($pengirim->getTable())->where()->manySearchCharacter($pencarian,$tipe)->limit($paging['firstOfValue'],$paging['sumOfData'])->ready();

                                if($pengirim->getStatement()->rowCount()){
                                    while($row = $pengirim->getStatement()->fetch()) { ?>
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
                <!-- end Box Data pengirim -->

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