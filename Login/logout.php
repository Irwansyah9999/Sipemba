<?php
    require_once('../engine/config/Loader.php');

	Loader::autoLoaderUnregister('../engine/config',['Loader.php']);
    
    $view = new View(true);
    
    session_destroy();

    $view->redirect('');
?>