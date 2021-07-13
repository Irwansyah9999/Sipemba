<?php

if(isset($_GET['cari'])){
    $search = array();

    foreach ($_GET as $key => $value) {
        if($value != ''){
            array_push($search,$key.'='.$value);
        }
    }

    header('Location:../?'.implode('&',$search));
}
?>