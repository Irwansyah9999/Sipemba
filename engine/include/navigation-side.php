<?php
    if($view->getSession('akses') == ''){ ?>
        <div class="col-90pc-nd bd-shadow">
            <h3>Silahkan Login</h3>

            <?php 
            if($view->getNotification() != ''){ ?>
                <div class="row-mg pad-5px btn-warning">
                    <?= $view->getNotification() ?>
                </div>
            <?php 
                }
            ?>
            <form action="Login/login.php" method="post">
                <input type="text" name="username" class="form-control-v2" placeholder="USERNAME">

                <input type="password" name="password" class="form-control-v2" placeholder="PASSWORD">

                <button type="submit" class="btn btn-safe" name="login">LOGIN</button>
            </form>
        </div>    
    <?php
    }else{ ?>
        <div class="box-lg bd-shadow">
            <div class="header">Menu</div>
            <div class="body">
                <div class="col-90pc-nd nav-side-v2">
                    <?php 
                        switch ($view->getSession('akses')) {
                            case 'karyawan': ?>

                                <div><a href="<?= $view->url('Pengiriman/') ?>" class="c-black">Pengiriman</a></div>
                                <div><hr></div>

                                <div><a href="<?= $view->url('User-Profile/') ?>" class="c-black">User Profile</a></div>
                                <?php    
                                break;
                            
                            case 'kb': ?>
                                <div><a href="<?= $view->url('Barang/') ?>" class="c-black">Barang</a></div>
                                <div><a href="<?= $view->url('Cek-point/') ?>" class="c-black">Cek Point</a></div>
                                <div><a href="<?= $view->url('Karyawan/') ?>" class="c-black">Karyawan</a></div>
                                <div><a href="<?= $view->url('Penerima/') ?>" class="c-black">Penerima</a></div>
                                <div><a href="<?= $view->url('Pengirim/') ?>" class="c-black">Pengirim</a></div>
                                <div><hr></div>

                                <div><a href="<?= $view->url('Pengiriman/') ?>" class="c-black">Pengiriman</a></div>

                                <div><hr></div>

                                <div><a href="<?= $view->url('User-Profile/') ?>" class="c-black">User Profile</a></div>
                                <?php
                                break;
                            
                            default:
                                
                                break;
                        }
                    ?>
                </div>
            </div>
        </div>
    <?php 
    }
?>