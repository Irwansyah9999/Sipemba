<?php

class Loader{

    static function autoLoaderUnregister(string $directory,array $unregister = array()){
        $files = array();
        $dir = scandir($directory);
        $register = "";
        
        for ($i=2; $i < count($dir); $i++) {
            
            if($unregister != array()){
                foreach ($unregister as $value) {
                    $register = $dir[$i] != $value? $dir[$i] :"0";
    
                    if(file_exists($directory.'/'.$register)){
                        
                        require_once($directory.'/'.$register);
                    }
                }
            }else{
                if(file_exists($directory.'/'.$dir[$i])){
                        
                    require_once($directory.'/'.$dir[$i]);
                }
            }
            
        }
    }

    static function autoLoaderRegister(string $directory,array $register = array()){
        $files = array();
        $dir = scandir($directory);
        $regis = "";
        
        for ($i=2; $i < count($dir); $i++) {
            
            if($register != array()){
                foreach ($register as $value) {
                    $regis = $dir[$i] == $value? $dir[$i] :"0";
    
                    if(file_exists($directory.'/'.$regis)){
                        require_once($directory.'/'.$regis);
                    }
                }
            }else{
                if(file_exists($directory.'/'.$dir[$i])){
                        
                    require_once($directory.'/'.$dir[$i]);
                }
            }
            
        }
    }

}

?>