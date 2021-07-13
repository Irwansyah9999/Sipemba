<?php 

    // read file
    function read(string $pathFile,$line = 0){
        $config = fopen($pathFile,'r');

        $configs = array();
        while ($cek = fgets($config)) {
            array_push($configs,$cek);
        }

        fclose($config);

        return $configs[$line];
    }

    // write file
    function write(string $pathFile,$textBefore,$textAfter){
        
        $boolWrite = false;

        // get text
        $get = file_get_contents($pathFile);

        if(file_exists($pathFile)){
            if(strpos($get,$textBefore)){
                $replace = str_replace($textBefore,$textAfter,$get);

                $config = fopen($pathFile,'w');
                
                fwrite($config,$replace);

                fclose($config);

                $boolWrite = true;
            }
        }else{
            echo 'File tidak tersedia';
        }

        return $boolWrite;
    }

    // remove file
    function remove($pathfile,$message = ''){
        if(file_exists($pathfile)){
            if(unlink($pathfile)){
                echo $message;
            }
        }else{
            echo "File tidak tersedia";
        }
    }

       /* upload file image
    * filename = nama file dari form data,
    * newFile = nama baru dari file
    * location = lokasi disimpannya file (dalam folder files)
    * allow_ext = array yang berisi ekstensi file yang diperbolehkan example:['txt','png'] atau array('txt','png')
    */
    function upload($filename,$newfile,$location,array $allow_ext,int $maxSize,$replace = false){
        // 1 KB = 1048,576 byte
        $maxSize = $maxSize * 1048.576;
        $file = '';
        $pesan="";

        $file_name = $_FILES[$filename]['name'];

        $file_ext = explode(".", $file_name);

        $file_size = $_FILES[$filename]['size'];
        $file_temp = $_FILES[$filename]['tmp_name'];

        $panjang = count($file_ext) - 1;

        $file_ext_new = $file_ext[$panjang];

        if (in_array($file_ext_new, $allow_ext) === true) {
            if ($file_size < $maxSize){
                $i = 0;

                do {
                    if(file_exists($location.$newfile.'.'.$file_ext_new)){
                        $file = $newfile.'.'.$file_ext_new;
                        $i++;
                        $newfile .= "($i)";
                    }else{
                        $file = $newfile.'.'.$file_ext_new;
                        $lokasi = $location.$file;
                        
                        $in = move_uploaded_file($file_temp, $lokasi);
                        $replace = false;
                    }
                } while ($replace);
                
            } else {
                $pesan = 'File error: besar maksimal '.$maxSize.' KB';   
            }
        }else {
            $pesan = 'ekstensi file tidak di izinkan';
        }
        

        $uploadArray = array('pesan' => $pesan,'file' => $file,'ektensi'=>$file_ext_new);

        return $uploadArray;
    }

    /*
    * pembacaan data csv
    * $columnname = tipe pengambilan data, COLUMN_NUMBER;COLUMN_NAME;COLUMN_BOTH
    */
    function readCsv($filename,$columnname = 'COLUMN_NUMBER',$delimiter = ';'){
        $datacsv = array();
        if(file_exists($filename)){
            $file = fopen($filename,'r');
            $header = fgetcsv($file,0,$delimiter);

            $datacsv['header'] = $header;
            
            $countArray = 0;
            while($row = fgetcsv($file,0,$delimiter)){
                if($columnname == 'COLUMN_NAME'){
                    $i = 0;
                    while($i < count($header)){
                        $datacsv[$countArray][$header[$i]] = $row[$i];
                        $i++;
                    }

                    $countArray++;
                }else if($columnname == 'COLUMN_NUMBER'){
                    array_push($datacsv,$row);
                }else if($columnname == 'COLUMN_BOTH'){
                    $i = 0;
                    while($i < count($header)){
                        $datacsv[$countArray][$header[$i]] = $row[$i];

                        $datacsv[$countArray][$i] = $row[$i];
                        $i++;
                    }
                    $countArray++;
                }
            }

            fclose($file);
        }

        return $datacsv;
    }

    // mendapatkan tanggal dengan interval tertentu; return array
    function getDatetimes($datetimes,int $interval,string $unary = 'decrement',array $dateArray = []){
        
        // get date & time 
        // type string
        $date = explode(' ',$datetimes)[0];
        $time = explode(' ',$datetimes)[1];

        // get part of date
        $year = intval(explode('-',$date)[0]);
        $month = intval(explode('-',$date)[1]);
        $day = intval(explode('-',$date)[2]);

        // get part of time
        $hour = explode(':',$time)[0];
        $minute = explode(':',$time)[1];
        $second = explode(':',$time)[2];
        
        $monthSeparator = array(1 => 31,
                                2 => 28,
                                3 => 31,
                                4 => 30,
                                5 => 31,
                                6 => 30,
                                7 => 31,
                                8 => 31,
                                9 => 30,
                                10 => 31,
                                11 => 30,
                                12 => 31);

        $hourSeparator = 23;
        $minuteSeparator = 59;

        if($interval != 0){
            if($day > 1 && $day < 28){
                $day = ($unary == 'decrement')?--$day:++$day;
            }else{
                if($unary == 'decrement'){
                    if($month == 1){
                        $month = 12;
                        $year--;
                    }else{
                        $month--;
                    }

                    $day = ($year % 4 == 0 && $month == 2)?29:$monthSeparator[$month];
                }else{
                    if($month == 12){
                        $month = $day < $monthSeparator[$month]?$month:1;
                        $year = $day < $monthSeparator[$month]?$year:++$year;
                        
                    }else{
                        $month = $day < $monthSeparator[$month]?$month:++$month;
                    }
                    
                    $day = ($year % 4 == 0 && $month == 2)?++$day:$day;

                    $day = $day < $monthSeparator[$month]?++$day:1;

                }
            }

            $monthStr = (($month < 10) ?"0$month":$month);
            $dayStr = (($day < 10) ?"0$day":$day);
            $datetimes = "$year-$monthStr-$dayStr $hour:$minute:$second";

            array_push($dateArray,$datetimes);

            return getDatetimes($datetimes,$interval - 1,$unary,$dateArray);
        }else{
            return $dateArray;
        }
    }

    function sendEmail($kepada,$subjek,$pesan,$dari){
        $kirim = mail($kepada,$subjek,$pesan,$dari);

        if($kirim){ ?>
            <script>
                alert('Pengiriman email pada hari ini telah dilakukan');
            </script>
        <?php     
            return true;
        }else{
            return false;
        }
        
    }


    function reload(int $batas){
        $anggota = new Anggota();
        $peminjaman = new Pinjam();
        $peminjaman->select($peminjaman->getTable())->ready();

        $email = new Email();

        if($peminjaman->getStatement()->rowCount()){
            while($rowPeminjaman = $peminjaman->getStatement()->fetch()){
            
                $dataAnggota = $anggota->select($anggota->getTable(),'distinct')->where()->comparing("kode_anggota",$rowPeminjaman['kode_anggota'])->goData();
                
                $message = "Buku yang anda pinjam pada tanggal ".$rowPeminjaman['tanggal_peminjaman']." Akan berakhir pada tanggal ".$rowPeminjaman['tanggal_berakhir'].".
                Supaya tidak terkena denda jangan lupa untuk mengembalikan buku sebelum tanggal berakhir yahh";
        
                $dateArray = getDatetimes($rowPeminjaman['tanggal_berakhir']." 00:00:00",$batas);
        
                if($rowPeminjaman['status_peminjaman'] != 'pengembalian'){
                    foreach ($dateArray as $value) {
                        $email->select($email->getTable())->where()
                        ->comparing("kepada",$dataAnggota[0]['email_anggota'])
                        ->and()->comparing("tanggal_email",date('Y-m-d'))->ready();

                        if(date('Y-m-d') == explode(' ',$value)[0] && !$email->getStatement()->rowCount()){
                            $kode = $dataAnggota[0]['kode_anggota'].time();
                            $email->fields = [$kode,date('Y-m-d'),$dataAnggota[0]["email_anggota"],"Notifikasi Peminjaman Buku",$message,"from: admin@localhost"];
                            if(!$email->saveData()->ready('execute')){
                                sendEmail($dataAnggota[0]["email_anggota"],"Notifikasi Peminjaman Buku",$message,"from: admin@localhost");
                            }          
                        }else{
                            if(date('Y-m-d') == explode(' ',$value)[0]){
                                
                            }
                        }
                    }
                }else{
                    echo "Peminjaman dengan kode anggota ".$rowPeminjaman['kode_peminjaman']." telah selesai ";
                }
        
            }
        }else{
            echo "Belum ada peminjaman";
        }
    }
?>