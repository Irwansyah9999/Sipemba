<?php
    include_once('../engine/config/Loader.php');

    Loader::autoLoaderUnregister('../engine/config',['Loader.php']);
    Loader::autoLoaderRegister('../engine/model',['Pengiriman.php','PengirimanDetail.php','Pengirim.php','Penerima.php','CekPoint.php','Barang.php','BarangDetail.php']);

    $view = new View(true);
    $pengiriman = new Pengiriman();
    $pengirimanDetail = new PengirimanDetail();
    $pengirim = new Pengirim();
    $penerima = new Penerima();
    $cekPoint = new CekPoint();
    $barang = new Barang();
    $barangDetail = new BarangDetail();

    $dataProvinsi = $cekPoint->select($cekPoint->getTable(),['kode_cp','provinsi','kab_kota'])->grouping('kab_kota')->go();

    $dataKota = $cekPoint->select($cekPoint->getTable(),['kode_cp','kab_kota'])->go();

    if($view->getSession('akses') == null){
        $view->redirect('');
    }

    $view->accesSession(['kb'],$view->getSession('akses'),1,'',true);

    $head = 'SiPEMBA';

    $view->setHeading("$head | Pengiriman");

    // atribut
    $atribut = $view->gets(['action' => '','page' => 1,'maxLength' => 5,'log' => '../']);

    $url = http_build_query($_GET);

    $field = ['Kode','Tanggal','Status','Berat Pengiriman','harga'];

    $fieldDetail = ['Kode','Tanggal','Status','Cek Point','Jenis','keterangan','nip'];

    // pencarian
    $tipe = $view->get('tipe');
    $pencarian = array('kode_pengiriman' => $view->get('kode'),'tanggal_pengiriman' => $view->get('tanggal'),'status_pengiriman' => $view->get('status'),'massa_pengiriman' => $view->get('massa'),
    'kode_pengirim' => $view->get('kode_p'),'kode_penerima' => $view->get('kode_pe'),'kode_barang' => $view->get('kode_b'));


    $pencarianDetail = array('kode_pengiriman' => $view->get('kode'),'tanggal_detail' => $view->get('tanggal'),'status_detail' => $view->get('status'),
    'cek_point' => $view->get('cek_point'),'jenis_detail' => $view->get('jenis'),'keterangan' => $view->get('keterangan'),'nip' => $view->get('nip'));

    // brum
    $view->list = ['head' => 'Pengelolaan Pengiriman','list' => 'Home > Pengiriman'];

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
                        DATA PENGIRIMAN 
                            <button type="button" class="btn btn-safe" id="btn-add-pengiriman">+</button>
                            <button type="button" class="btn btn-safe" onclick="onLocation('?action=paper')">Rekap</button>

                            <!-- set -->
                            <div class="row-mg" id="bx-barang">
                                <div class="float-right">
                                    <button type="button" class="btn-lg btn-danger" id="btn-barang">X</button>
                                </div><div class="clear-right"></div>

                                <form action="" method="get">
                                    <input type="text" name="action" value="add" class="ds-none">

                                    <label>Jumlah barang</label>
                                    <input type="number" name="jumlah_barang" class="form-control-nl" placeholder="masukan jumlah barang jumlah barang yang dikirim">

                                    <button type="submit" class="btn btn-safe">Tambah</button>
                                </form>
                            </div>
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
                                </div><div class="clear-both"></div>

                                <?php include_once('searching.php') ?>
                            </div>
                        </div>
                        <!-- end pencarian dan tampil data -->

                        <?php include_once('../engine/include/notif.php') ?>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                        <th>No</th>
                                <?php 
                                    foreach ($field as $key => $value) { ?>
                                        <th><?= $value ?></th>
                                <?php 
                                    }
                                ?>
                                    <th>Pengirim</th>
                                    <th>Penerima</th>
                                    <th>Barang</th>
                                        <th colspan="3">Aksi</th>
                                </thead>
                                <tbody>
                                <?php 
                                    $data = ($tipe == '')?$pengiriman->select($pengiriman->getTable(),['count(*)'])->go():
                                    $pengiriman->select($pengiriman->getTable(),['count(*)'])->where()->manySearchCharacter($pencarian,$tipe)->go();
                                    
                                    $paging = $view->paging($atribut['page'],$atribut['maxLength'],$data[0][0]);
    
                                    // set
                                    ($tipe == '')?$pengiriman->select($pengiriman->getTable())->limit($paging['firstOfValue'],$paging['sumOfData'])->ready():
                                    $pengiriman->select($pengiriman->getTable())->where()->manySearchCharacter($pencarian,$tipe)->limit($paging['firstOfValue'],$paging['sumOfData'])->ready();

                                    if($pengiriman->getStatement()->rowCount()){
                                        while($row = $pengiriman->getStatement()->fetch()) { ?>
                                            <tr>
                                            <td><?= $paging['noOfData']++ ?></td> 
                                            <?php 
                                            // cetak data
                                            for ($i=0; $i < count($field); $i++) { ?>
                                                <td><?= $row[$i] ?></td>  
                                            <?php
                                            }
                                            ?>
                                                <td>
                                                <?php $dataPengirim = $pengirim->select($pengirim->getTable())->where()->comparing('kode_pengirim',$row['kode_pengirim'])->go() 
                                                
                                                ?>
                                                
                                                <?= $row['kode_pengirim'].'-'.$dataPengirim[0]['nama_pengirim'] ?>
                                                </td>

                                                <td>
                                                
                                                <?php $dataPenerima = $penerima->select($penerima->getTable())->where()->comparing('kode_penerima',$row['kode_penerima'])->go() 
                                                
                                                ?>
                                                <?= $row['kode_penerima'].'-'.$dataPenerima[0]['nama_penerima'] ?>
                                                </td>
                                                <td>
                                                <?php $dataBarang = $barang->select($barang->getTable())->where()->comparing('kode_barang',$row['kode_barang'])->go() 
                                                
                                                ?>

                                                <?= $row['kode_barang'].'-'.$dataBarang[0]['keterangan_barang'] ?>
                                                </td>

                                                <td><button type="button" class="btn btn-safe" name="detail" onclick="onLocation('?action=detail&id=<?= $row['kode_pengiriman'] ?>')">Detail</button></td>
                                                <td><button type="button" class="btn btn-warning" name="perbarui" onclick="onLocation('?action=update&id=<?= $row['kode_pengiriman'] ?>')">Lakukan Pengiriman</button></td>
                                                <td><button type="button" class="btn btn-danger" name="hapus" onclick="confirmation('Apakah anda yakin ?','aksi/delete.php?id=<?= $row['kode_pengiriman'] ?>')">hapus</button></td>
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
                    }else if($atribut['action'] == 'add'){
                        include_once('add.php');
                    }else if($atribut['action'] == 'update'){
                        include_once('updating.php');
                    }else if($atribut['action'] == 'paper'){
                        include_once('paper.php');
                    }else if($atribut['action'] == 'detail'){
                        include_once('detail.php');
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