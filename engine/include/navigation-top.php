<!-- navigation -->
<nav class="nav-v2 btn-safe jc-end ai-center">
    <div class="left"><a href="<?= $view->url('') ?>" class="c-white"><img src="<?= $view->url('engine/img/Pengiriman 3.jpg') ?>" alt="" width="50px" class="bd-radius-arround"></a></div>
    <div class=""><a href="" class="c-white">Layanan</a></div>
    <div class=""><a href="" class="c-white">Customer Servis</a></div>

    <?php
    if ($view->getSession('akses') != '') { ?>
        <div class=""><button type="button" class="btn btn-warning" onclick="confirmation('Apakah Anda Yakin ?','<?= $atribut['log'] ?>Login/logout.php')">LOG OUT</button></div>  
    <?php
    }
    ?>
</nav>