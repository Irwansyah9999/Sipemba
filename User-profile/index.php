<?php
    include_once('../engine/config/Loader.php');

    Loader::autoLoaderUnregister('../engine/config',['Loader.php']);
    Loader::autoLoaderRegister('../engine/model',['Pengguna.php','Karyawan.php']);

    $view = new View(true);
    $pengguna = new Pengguna();
    $karyawan = new Karyawan();

    $head = 'SiPEMBA';

    $view->setHeading("$head | Selamat Datang");

    // pencarian
    $pencarian = array('kode_pengiriman' => $view->get('kode'));

    // set
    $update = isset($_GET['update'])?$_GET['update']:"";

    $table = '';
    
    $dataDetail = $pengguna->select($pengguna->getTable())->where()->comparing('kode_pengguna',$view->getSession('id'))->goData();

    $penggunaDetail = $karyawan->select($karyawan->getTable())->where()->comparing('nip',$view->getSession('id'))->goData();

    $view->list = ['head' => 'User Profile Brother '.$view->getSession('nama'),'list' => 'Home > User Profile'];

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

            <div class="clear-both"></div>
        </div>

        <!-- brum -->
        <?php include_once('../engine/include/brum.php') ?>

        <!-- content and side -->
        <div class="row">
        
            <!-- content -->
            <div class="offset-5pc col-60pc float-left bd-shadow txt-center">
                <table class="table max-width">
                    <tr>
                        <td>Nama</td>
                        <td><?= $penggunaDetail[0][1] ?></td>
                    </tr>
                    <tr>
                        <td>Tempat Lahir</td>
                        <td><?= $penggunaDetail[0][2] ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td><?= $penggunaDetail[0][3] ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?= $penggunaDetail[0]['email_karyawan'] ?></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><?= $dataDetail[0]['password'] ?></td>
                    </tr>
                    <tr>
                        <td>Telepon</td>
                        <td><?= $penggunaDetail[0]['telepon_karyawan'] ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><?= $penggunaDetail[0]['alamat_karyawan'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a class="btn btn-safe" href="?update=active">Perbarui</a> &nbsp;&nbsp;
                        </td>
                    </tr>
                </table>
            </div>

            <?php 
            if($update == 'active'){ ?>
                <div class="offset-5pc col-60pc bd-shadow">
                    <button type="button" class="btn-lg btn-danger float-right" onclick="onLocation('?update');">&times;</button>

                    <h3>Perbarui Data Berdasarkan Kode <?= $view->getSession('id') ?></h3>

                    <br>
                    <form action="aksi/perbarui.php" method="post">
                        <input type="text" name="kode" placeholder="Kode" class="form-control" value="<?= $penggunaDetail[0]['nip'] ?>" readonly>

                        <input type="text" name="nama" placeholder="Nama" class="form-control" value="<?= $penggunaDetail[0]['nama_karyawan'] ?>">

                        <input type="text" name="tempat_lahir" placeholder="Tempat Lahir" class="form-control" value="<?= $penggunaDetail[0]['tempat_lahir_karyawan'] ?>">

                        <input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir" class="form-control" value="<?= $penggunaDetail[0]['tanggal_lahir_karyawan'] ?>">
                        
                        <select name="jenis_kelamin" class="form-control">
                            <option value="L" <?php if($penggunaDetail[0]['jenis_kelamin_karyawan'] == "L"){ ?> selected <?php } ?>>Laki - Laki</option>
                            <option value="P" <?php if($penggunaDetail[0]['jenis_kelamin_karyawan'] == "P"){ ?> selected <?php } ?>>Perempuan</option>
                        </select>      
                    

                        <input type="text" name="email" placeholder="Email" class="form-control" value="<?= $penggunaDetail[0]['email_karyawan'] ?>">
                        
                        <input type="text" name="password" placeholder="Password" class="form-control" value="<?= $dataDetail[0]['password'] ?>">

                        <input type="text" name="telepon" placeholder="No. Telepon" class="form-control" value="<?= $penggunaDetail[0]['telepon_karyawan'] ?>">

                        <textarea name="alamat" cols="30" rows="10" class="form-control" placeholder="Alamat"><?= $penggunaDetail[0]['alamat_karyawan'] ?></textarea>
                            
                        <button type="submit" class="btn btn-safe" name="perbarui">Perbarui</button>
                    </form>
                </div>
            <?php 
            }
            ?>

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
                if($view->getSession('akses') == ''){
                    include_once('../engine/include/login.php');
                }else{
                    include_once('../engine/include/navigation-side.php');
                }
                ?>
                
            </div>
            
            <div class="clear-both"></div>
        </div>

        <?php include_once('../engine/include/footer.php') ?>

        <script src="<?= $view->url('engine/js/cb.js') ?>"></script>
        <script src="<?= $view->url('engine/js/anythink.js') ?>"></script>
    </div>
</body>
</html>