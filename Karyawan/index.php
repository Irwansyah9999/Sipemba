<?php
    include_once('../engine/config/Loader.php');

    Loader::autoLoaderUnregister('../engine/config',['Loader.php']);
    Loader::autoLoaderRegister('../engine/model',['Karyawan.php']);

    $view = new View(true);
    $karyawan = new Karyawan();

    if($view->getSession('akses') == null){
        $view->redirect('');
    }

    $view->accesSession(['kb'],$view->getSession('akses'),1,'',true);

    $head = 'SiPEMBA';

    $view->setHeading("$head | Karyawan");

    // atribut
    $atribut = $view->gets(['action' => '','page' => 1,'maxLength' => 5,'log' => '../']);

    $url = http_build_query($_GET);

    $field = ['Kode','Nama','Tempat Lahir','Tanggal Lahir','Jenis Kelamin','Divisi','Jabatan','Email','Telepon','Alamat'];

    // pencarian
    $tipe = $view->get('tipe');
    $pencarian = array('nip' => $view->get('nip'),'nama_karyawan' => $view->get('nama'),'tempat_lahir_karyawan' => $view->get('tempat_lahir'),
                        'tanggal_lahir_karyawan' => $view->get('tempat_lahir'),'jenis_kelamin_karyawan' => $view->get('jenis_kelamin'),'divisi_karyawan' => $view->get('divisi'),'jabatan_karyawan' => $view->get('jabatan'),
                        'email_karyawan' => $view->get('email'),'telepon_karyawan' => $view->get('telepon'));

    // brum
    $view->list = ['head' => 'Pengelolaan Karyawan','list' => 'Home > Karyawan'];
    
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

                <?php if($atribut['action'] == ''){ ?>
                
                <!-- Box Data pengirim -->
                <div class="box-lg bd-shadow bd-radius-5px">
                    <div class="header">
                        DATA KARYAWAN 
                            <button type="button" class="btn btn-safe" onclick="onLocation('?action=add&#add')">+</button>
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
                                    <th colspan="2">Aksi</th>
                                </thead>
                                <tbody>
                            <?php 
                                $data = ($tipe == '')?$karyawan->select($karyawan->getTable(),['count(*)'])->go():
                                $karyawan->select($karyawan->getTable(),['count(*)'])->where()->manySearchCharacter($pencarian,$tipe)->go();
								
                                $paging = $view->paging($atribut['page'],$atribut['maxLength'],$data[0][0]);

                                // set
                                ($tipe == '')?$karyawan->select($karyawan->getTable())->limit($paging['firstOfValue'],$paging['sumOfData'])->ready():
                                $karyawan->select($karyawan->getTable())->where()->manySearchCharacter($pencarian,$tipe)->limit($paging['firstOfValue'],$paging['sumOfData'])->ready();

                                if($karyawan->getStatement()->rowCount()){
                                    while($row = $karyawan->getStatement()->fetch()) { ?>
                                        <tr>
                                           <td><?= $paging['noOfData']++ ?></td> 
                                        <?php 
                                        // cetak data
                                        for ($i=0; $i < count($field); $i++) { ?>
                                            <td><?= $row[$i] ?></td>  
                                        <?php
                                        }
                                        ?>
                                            <td><button type="button" class="btn btn-warning" name="perbarui" onclick="onLocation('?action=update&id=<?= $row['nip'] ?>&#pb')">perbarui</button></td>
                                            <td><button type="button" class="btn btn-danger" name="hapus" onclick="confirmation('Apakah anda yakin ?','aksi/delete.php?id=<?= $row['nip'] ?>')">hapus</button></td>
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