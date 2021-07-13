<?php
    include_once('engine/config/Loader.php');

    Loader::autoLoaderUnregister('engine/config',['Loader.php']);
    Loader::autoLoaderRegister('engine/model',['Pengiriman.php','PengirimanDetail.php']);

    $view = new View(true);
    $pengiriman = new Pengiriman();
    $pengirimanDetail = new PengirimanDetail();

    $head = 'SiPEMBA';

    $view->setHeading("$head | Selamat Datang");
    $atribut = $view->gets(['action' => '','page' => 1,'maxLength' => 5,'log' => '']);

    $field = ['Kode','Tanggal','Status','Berat Pengiriman','Pengirim','Penerima','kode barang'];

    $fieldDetail = ['Kode','Tanggal','Status','Cek Point','Jenis','keterangan','nip'];

    // pencarian
    $pencarian = array('kode_pengiriman' => $view->get('kode'));

    // brum
    $view->list = ['head' => 'Selamat Datang Brother '.$view->getSession('nama'),'list' => 'Home'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once('engine/include/heading.php') ?>
</head>
<body>
    <div class="container">
        <!-- heading, heading right and navigation -->
        
        <div class="row" id="top-header">
            <!-- navigation -->
            <?php include_once('engine/include/navigation-top.php') ?>

            <!-- heading -->
            <?php include_once('engine/include/header.php') ?>

            <!-- image -->
            <?php include_once('engine/include/header-right.php') ?>

            <div class="clear-both"></div>
        </div>

        <!-- brum -->
        <?php include_once('engine/include/brum.php') ?>

        <!-- content and side -->
        <div class="row-mg">
            <!-- content -->
            <div class="offset-5pc col-60pc float-left txt-justify">
            <?php 
                if($view->getSession('akses') != null){ ?>
                    <div class="box-lg bd-shadow">
                        <div class="header">
                            Pengiriman
                        </div>
                        <div class="body">
                            <table class="table">
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
                                    $no = 1;
                                    $data = $pengiriman->select($pengiriman->getTable())->ready();

                                    if($pengiriman->getStatement()->rowCount()){
                                        while($row = $pengiriman->getStatement()->fetch()) { ?>
                                            <tr>
                                                <td><?= $no++ ?></td> 
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
                        </div>
                    </div>    
                <?php
                }
                ?>
                
                <div class="box-lg">
                    <div class="body">
                        Kami adalah jasa ekpedisi pengiriman barang yang berpusat ditangerang, berlokasi di jalan raya serang No. 17 km 11.5 Bitung
                    </div>
                
                </div>
                <div class="box-lg">
                    <div class="header-nbg c-black">
                        <span class="bd-bottom pad-bottom-5px">Layanan</span>
                    </div>
                    <div class="body">
                        jenis barang yang dikirim yaitu barang industri, hasil perkebunan dan lainnya dengan massa bobot yang berat. 
                        Pengiriman diangkut dengan truk atau kapal kargo sesuai dengan lokasi pengiriman barang, jangkauan ekspedisi kami berada diseluruh pulau sumatera, kalimantan dan sebagian dipulau sulawesi. 
                    </div>
                </div>


                <div class="box-lg">
                    <div class="header-nbg c-black">
                        <span class="bd-bottom pad-bottom-5px">Customer Service</span>
                    </div>
                    <div class="body">
                        Untuk mendapatkan informasi lebih lanjut anda bisa menghubungi kami melalui email dan no telepon yang sudah tertera atau anda bisa juga mendatangi cabang-cabang terdekat dari ekspedisi kami.
                    </div>
                </div>                
            </div>

            <!-- side -->
            <div class="col-25pc float-right">
            <?php 
            if($view->getNotification() != ''){ ?>
                <div class="row-mg pad-5px btn-warning">
                    <?= $view->getNotification() ?>
                </div>
            <?php 
                }
            ?>

            <?php 
                if(isset($_GET['cari'])){
                    $kode = $view->get('pengiriman');
                    
                    $dataPengirim = $pengiriman->select($pengiriman->getTable())->where()->comparing('kode_pengiriman',$kode)->go();
                    $dataPengirimDetail = $pengirimanDetail->select($pengirimanDetail->getTable())->where()->comparing('kode_pengiriman',$kode)->go();

                    if ($kode != '') {
                        if($dataPengirim != array()){
                            $view->notif('Data Pengiriman dengan Kode '.$kode.' tersedia');
                            ?>
                            <div class="row-mg bd-shadow">
                                <table>
                                    <tr>
                                        <td>Tanggal Pengiriman</td>
                                        <td>:</td>
                                        <td><?= $dataPengirim[0]['tanggal_pengiriman'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status Pengiriman</td>
                                        <td>:</td>
                                        <td><?= $dataPengirim[0]['status_pengiriman'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Cek Point</td>
                                        <td>:</td>
                                        <td><?php
                                        if($dataPengirimDetail != array()){
                                            for ($i=0; $i < count($dataPengirimDetail); $i++) { ?>
                                                <p><?= $dataPengirimDetail[$i]['cek_point'].' - '.$dataPengirimDetail[$i]['status_detail'] ?></p><br>
                                            <?php
                                            }
                                        }else{
                                            echo "belum dilakukan pengiriman";
                                        }
                                        ?></td>
                                    </tr>
                                </table>
                            </div>
                        <?php
                        }else{ ?>

                        <?php
                        }
                    }
                }
                
                if($view->getSession('akses') == ''){
                    include_once('engine/include/login.php');
                }else{
                    include_once('engine/include/navigation-side.php');
                }
                ?>
            </div>
            
            <div class="clear-both"></div>
        </div>

        <?php include_once('engine/include/footer.php') ?>

        <script src="<?= $view->url('engine/js/cb.js') ?>"></script>
        <script src="<?= $view->url('engine/js/anythink.js') ?>"></script>
    </div>
</body>
</html>