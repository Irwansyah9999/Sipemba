<?php 
    class View{

        // request
        public $host = 'http://localhost';
        public $home = '/SiPEMBA/';
        public $heading = '';
        public $list = array('head' => 'Selamat Datang','list' => 'Home');

        // waktu
        public $timezone = 'Asia/jakarta';

        // response
        public $sessionPage = "engine/include/error-page.php";

        // file
        public $file = 'engine/file/';

        function __construct($session = false){
            if($session){
                session_start();
            }

            date_default_timezone_set($this->timezone);
        }

        /**
         * function not editable
         */

        // Request
        function url(string $path){
            return $this->host.$this->home.$path;    
        }

        function urlBack(string $path){
            return $_SERVER['HTTP_REFERER'];
        }

        function form(string $path){
            return $this->host.$this->home.$this->control.$path;
        }

        function inc($location){
            
            include_once($this->url($location));
            
        }

        function drive(string $path,$subDirectory = 0){
            $directory = '';

            for ($i=0; $i < $subDirectory; $i++) { 
                $directory .= '../';
            }

            return $directory.$this->file.$path;
        }

        function request(string $path,string $file){
            $url = $this->url($path);
            $urlNow = $_SERVER['REQUEST_URI'];

            if($url == $urlNow){
                $this->response($file);
            }
        }

        function gets(array $get){
            $newPost = array();
            $boolean = false;
            foreach ($get as $key => $value) {
                $newPost[$key] = isset($_GET[$key])?$_GET[$key]:$value;
            }

            return $newPost;
        }

        function posts(array $post){
            $newPost = array();
            $boolean = false;

            foreach ($post as $key => $value) {
                if(isset($_POST[$value])){
                    $boolean = true;
                }

                $newPost[$value] = isset($_POST[$value])?$_POST[$value]:'';
            }

            if($boolean){
                return $newPost;
            }else{
                return;
            }
        }

        function post(string $post,string $type = 'string'){
            $newPost;
            if($type == 'string'){
                $newPost = isset($_POST[$post])?$_POST[$post]:'';
            }else{
                $newPost = isset($_POST[$post])?$_POST[$post]:0;
            }

            return $newPost;
        }

        function get(string $get,string $type = 'string',$default = ''){
            $newGet;

            if($type == 'string'){
                $newGet = isset($_GET[$get])?$_GET[$get]:'';
            }else{
                $newGet = isset($_GET[$get])?$_GET[$get]:0;
            }

            return $newGet;
        }

        function validation(array $data){
            $arrayMessage ='';
            $post = array();
            foreach ($data as $key => $value) {
                $post = isset($_POST[$key])?$_POST[$key]:'';
                $typeValidation = explode('/', $value);
                foreach ($typeValidation as $valueItem) {
                    switch ($valueItem){  
                        case 'null':
                            if($post == null){
                                $arrayMessage .= "$key is not null*";
                            }
                            break;
                        case 'number':
                            if(is_numeric($post)){
                                $arrayMessage .= "$key is not number*";
                            }
                            break;
                        case 'string':
                            if(is_string($post)){
                                $arrayMessage .= "$key is not string*";
                            }
                            break;
                        default :
                            exit();
                    }
                }
            }
            
            
            if($arrayMessage == ''){
                return $post;
            }else{
                $this->back($arrayMessage);
            }
        }

        function getNotification($cookie = 'notifikasi'){
            $notif = isset($_COOKIE[$cookie])?$_COOKIE[$cookie]:""; 
    
            return $notif;
        }


        // Response
        function response($file,$responseFile){
            if(file_exists($responseFile)){
                include_once($file);
            }
        }

        function back(string $notification=""){          
            $this->notif($notification);
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }

        function redirect(string $location,string $notification = ''){          
            $this->notif($notification);
            header('Location: '.$this->url($location));
        }

        function notif($notification,$time = 30) {
            setcookie("notifikasi", $notification, time()+$time,'/');
        }

        function setHeading(string $heading){
            $this->heading = $heading;
        }

        function getHeading(){
            return $this->heading;
        }

        // Pagination
        function paging(int $page,int $sumData,int $totalData){
            $totalPage = ceil($totalData / $sumData);

            $firstValue = ($page - 1)  * $sumData;
            $no = $firstValue + 1;

            return array('page' => $page,'sumOfData' => $sumData,'totalOfData'=>$totalData,
            'totalOfPage' =>$totalPage,'firstOfValue'=>$firstValue,'noOfData'=> $no);
        }

        // Session(hak akses)
        function getSession($name,$default = ""){
            $session = isset($_SESSION[$name])?$_SESSION[$name]:$default;

            return $session;
        }

        function noSession($location,$sessionName){
            if($this->getSession($sessionName) == null){
                $this->redirect($sessionName);
            }
        }
        /*
            pemeriksaan akses session untuk mengecek halaman yang memiliki akses tertentu
            $accesAvailable = akses yang diperbolehkan
            $accesName = nama aksesnya (diambil dari session akses)
            $subDirectory = berapa subdirectory dari file web tersebut ke folder utama

        */
        function accesSession(array $accesAvailable,string $accesName,int $subDirectory = 0,bool $accesPage = false){
            $boolAcces = false;
            $directory = '';

            for ($i=0; $i < $subDirectory; $i++) { 
                $directory .='../';
            }
            
            foreach ($accesAvailable as $value) {
                if($value == $accesName){
                    $boolAcces = true;
                }
            }

            if($accesPage){
                if(!$boolAcces){
                    include_once($directory.$this->sessionPage);
                    exit();
                }
            }

            return $boolAcces;
        }
        
        // selected data
        function selected($function,$data){

        }
    }

?>