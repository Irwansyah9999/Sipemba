<div class="paging bd-shadow">
    <?php $no = $atribut['page'] ?>
    <span>
    <a <?php if($atribut['page'] < $paging['totalOfPage'] || $atribut['page'] == 1){ ?> class="ds-none" <?php } ?> href="?<?= $url ?>&page=<?= --$no ?>">sebelumnya</a>
    </span>
    
<?php
    for ($i=1; $i <= $paging['totalOfPage']; $i++) { ?>
        <span class="<?php if($atribut['page'] == $i){?> active <?php } ?>">
        <a href="?<?= $url ?>&page=<?= $i ?>"><?= $i ?></a>
        </span>      
<?php
    }
?>
    <?php $no = $atribut['page'] ?>
    <span>
    <a <?php if($atribut['page'] >= $paging['totalOfPage']){ ?> class="ds-none" <?php } ?> href="?<?= $url ?>&page=<?= ++$no ?>">Selanjutnya</a>
    </span>
</div>