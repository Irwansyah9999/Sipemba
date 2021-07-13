<?php 
if($view->getNotification() != ''){ ?>
    <div class="row-mg pad-5px btn-warning">
        <?= $view->getNotification() ?>
    </div>
<?php 
    }
?>