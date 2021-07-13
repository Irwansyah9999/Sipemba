<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class Model{
    // var untuk pengenalan class lainnya
    
    private $con,$bq,$loader,$dml;
    private $stmt = "";
    
    // Data yang di gunakan untuk pengenalan data pada class model
    private $tableName="";
    private $fieldTable = array();
    private $query="";
    private $primaryKey="";
    private $foreignKey = "";
    
    /*
     *  variabel array untuk penyisipan data di luar kelas model
     * variabel array disesuaikan dengan variabel dari isi tabel sub kelas model
     * untuk tambah, edit dan delete
     */
    public $fields;
    
    // variabel pembantu
    public $column = 'None',$sort = 'None';
    
    // inisialisasi kelas 
    function initial() {
        $this->con = new Connection();
        $this->dml = new Query();
        
    }
    
    /***************************************************************************
     * fungsi set dan get
     * 
     **************************************************************************/
    
    // Mengatur nama tabel yang di buat
    function setTable(string $tableName) {
        $this->tableName = $tableName;
    }
    
    // mendapatkan nama tabel yang di buat
    function getTable() {
        return $this->tableName;
    }
    
    // mengatur field table yang di buat
    function setField(array $fieldTable) {
        $this->fieldTable = $fieldTable;
    }
    
    function getField() {
        return $this->fieldTable;
    }
    
    // mengatur id key untuk hapus dan update
    function setId($primaryKey) {
        $this->primaryKey = $primaryKey;
    }
    
    function getId() {
        return $this->primaryKey;
    }
	
    // memanggil statement yang sudah di buat
    function getStatement() {
        return $this->stmt;
    }
    
    /***************************************************************************
     * Data Manipulation Language 3 (Renew) 
     * Select data
     **************************************************************************/
    
    /*
     * fungsi eksekusi
     * param column = untuk memeriksa apakah statement tersebut terdapat field yang ikut dieksekusi
     * default = "" dan "execute untuk menambahkan field"
     */
    function ready($columns = ""){
        try{
            $this->stmt = $this->con->getConnection()->prepare($this->query);
            if($columns == "execute"){
                $this->stmt->execute($this->fields);
            }else{
                $this->stmt->execute();
            }
        } catch (\PDOException $ex) {
            echo 'Statement salah '.$ex->getMessage();
        }
    }
    
    function testQuery() {
        return $this->query;
    }
    
    /*
     * fungsi yang digunakan sebagai penghubung atau pun untuk query yang lumayan
     * rumit. 
     * berikut yang dimaksud dengan penghubung = where,between, and, or, having
     */
    public function queryCustom(string $link){
        $this->query .=" $link";
        
        return $this;
    }

    /*
     * fungsi untuk menampilkan tabel berdasarkan nama table dengan memperbolehkan 
     * nilai kolom ganda tampil ataupun tidak bergnatung dari parameter distinct.
     * 
     * isi parameter 
     * tablename = nama tabel yang dipilih
     * distinct = no, distinct
     */
    public function select(string $tablename,array $dataColumns = array(),string $distinct = 'no'){
        if($distinct == 'no'){
            $this->query = $this->dml->select($tablename,$dataColumns);
        }else if($distinct == 'yes'){
            $this->query =  $this->dml->selectDistinct($tablename,$dataColumns);
        }else{
            $this->query =  $this->dml->select($tablename,$dataColumns);
        }
        
        return $this;
    }

    public function where(){
        $this->query .= " where";
        
        return $this;
    }

    public function and(){
        $this->query .= " and";
        
        return $this;
    }

    public function or(){
        $this->query .= " or";
        
        return $this;
    }

    public function having(){
        $this->query .= " having";
        
        return $this;
    }

    public function join($table,$column1,$column2){
        $this->query .= " join $table ON $column1 = $column2";
        
        return $this;
    }

    public function between($column,$first,$end,$date = false){
        if($date){
            $this->query .= " $column between '$first' and '$end'";
        }else{
            $this->query .= " $column between $first and $end";
        }
        
        return $this;
    }

    /*
     * fungsi yang digunakan sebagai penyeleksi value dari kolom yang digunakan 
     * untuk menampilkan data, dengan syarat memanggil fungsi select() terlebih 
     * dahulu.
     * 
     * comparing = memilih operator sama dengan, tidak sama dengan ataupun lebih 
     * dan kurang dari, dengan nilai default : =. nilainya : > < = >= <= !=.
     * typeValues = mengganti param value dengan type string, default : ''. nilainya = string
     */
    public function comparing(string $columnName,$value,$typeValue="",$comparing='='){
        
        if($typeValue == 'string'){
            $value = "'".$value."'";
        }

        switch ($comparing) {
            case '=':
                $this->query .= $this->dml->equalColumn($columnName,$value);
                break;
            case '!=':
                $this->query .= $this->dml->notequalColumn($columnName,$value);
                break;
            case '>':
                $this->query .= $this->dml->operatorColumn($columnName,$value,'>');

                break;
            case '<':
                $this->query .= $this->dml->operatorColumn($columnName,$value,'<');

                break;
            case '>=':
                $this->query .= $this->dml->operatorColumn($columnName,$value,'>=');

                break;
            case '<=':
                $this->query .= $this->dml->operatorColumn($columnName,$value,'<=');

                break;
            default:
                break;
        }
        return $this;
    }


    public function manyComparing(array $columnNvalue,$driver = 'and',$comparing='='){
        $query = array();
        foreach ($columnNvalue as $key => $value) {
            switch ($comparing) {
                case '=':
                    array_push($query,$this->dml->equalColumn($key,$value));
                    break;
                case '!=':
                    array_push($query,$this->dml->notequalColumn($key,$value));

                    break;
                case '>':
                    array_push($query,$this->dml->operatorColumn($key,$value,'>'));
    
                    break;
                case '<':
                    array_push($query,$this->dml->operatorColumn($key,$value,'<'));

                    break;
                case '>=':
                    array_push($query,$this->dml->operatorColumn($key,$value,'>='));
    
                    break;
                case '<=':
                    array_push($query,$this->dml->operatorColumn($key,$value,'<='));
    
                    break;
                default:
                    break;
            }

        }

        $this->query .= implode(" $driver",$query);

        return $this;
    }
    
    /*
     * fungsi penyeleksi kolom berdasarkan karakter dengan syarat memanggil 
     * fungsi select() terlebih dahulu
     * 
     * type = like, unlike
     * position = front , central , back
     */
    public function searchCharacter(string $columnName,$value,$type='like',$position='front') {
        
        if($type == 'like'){
            $this->query .= $this->dml->like($columnName,$value,$position);
        }else if($type == 'unlike'){
            $this->query .= $this->dml->unlike($columnName,$value,$position);
        }else{
            $this->query .= $this->dml->like($columnName,$value,$position);
        }
        
        return $this;
    }

    public function manySearchCharacter(array $columnNvalue,$driver = 'and',$type='like',$position='front') {
        $query = array();
        foreach ($columnNvalue as $key => $value) {
            if($key != ''){
                if($type == 'like'){
                    array_push($query,$this->dml->like($key,$value,$position));
                }else if($type == 'unlike'){
                    array_push($query,$this->dml->unlike($key,$value,$position));
                }else{
                    array_push($query,$this->dml->like($key,$value,$position));
                }
            }
        }

        if($query != array()){
            $this->query .= implode(" $driver",$query);
        }
        
        return $this;
    }

    /*
     * mengurutkan data berdasarkan column yang bersangkutan
     * typesorting = asc , desc -> default asc
     */
    public function sorting($columnName,$typeSorting = 'ASC'){
        $this->query .= $this->dml->sorting($columnName,$typeSorting);
        
        return $this;
    }
    
    /*
     * group data berdasarkan dari kolom
     */
    function grouping($columnname) {
        $this->query .= $this->dml->grouping($columnname);
        
        return $this;
    }
    
    /*
     * pembatasan data berdasarkan pada nilai awal column
     */
    public function limit($firstColumn,$lastColumn){
        $this->query .= $this->dml->limit($firstColumn,$lastColumn);
        
        return $this;
    }
    
    /***************************************************************************
     * Data Manipulation Language 3 (Renew) 
     * Save , update, remove dan custom
     **************************************************************************/
    
    /*
    * versi save terbaru 
    * dengan penggunaan yg sedikit berbeda
    */ 
    public function saveData(){

        if($this->getField() == ""){
            echo "Field table belum di isi";
        }else if($this->getTable() == ""){
            echo "Nama table belum di isi";
        }else{
            $this->query = $this->dml->save($this->getTable(),$this->getField());
        }

        return $this;
    }

    /*
    * versi update terbaru
    * dengan penggunaan yg sedikit berbeda
    */ 
    public function updateData($id,$type = ''){

        if($type == 'string'){
            $id = "'".$id."'";
        }

        if($this->getField() == ""){
            echo "Field table belum di isi";
        }else if($this->getTable() == ""){
            echo "Nama table belum di isi";
        }else{
            $this->query = $this->dml->update($this->getTable(),$this->getField(),$this->getId(),$id);
        }

        return $this;
    }


    /*
    * versi update terbaru
    * dengan penggunaan customisasi bagian id
    */ 
    public function updateCustom(){

        if($this->getField() == ""){
            echo "Field table belum di isi";
        }else if($this->getTable() == ""){
            echo "Nama table belum di isi";
        }else{
            $this->query = $this->dml->updateCustom($this->getTable(),$this->getField());
        }

        return $this;
    }

    /*
    * versi update terbaru
    * dengan penggunaan yg sedikit berbeda
    */ 
    public function removeData($id,$type = ''){

        if($type == 'string'){
            $id = "'".$id."'";
        }

        if($this->getField() == ""){
            echo "Field table belum di isi";
        }else if($this->getTable() == ""){
            echo "Nama table belum di isi";
        }else{
            $this->query = $this->dml->delete($this->getTable(),$this->getId(),$id);
        }

        return $this;
    }


    /*
    * versi update terbaru
    * dengan penggunaan customisasi bagian id
    */ 
    public function removeCustom(){

        if($this->getField() == ""){
            echo "Field table belum di isi";
        }else if($this->getTable() == ""){
            echo "Nama table belum di isi";
        }else{
            $this->query = $this->dml->deleteCustom($this->getTable());
        }

        return $this;
    }

    /*
    * versi terbaru dalam mendapatkan data dengan kolom tertentu atau semuanya
    */
    public function goData($columnSet = FALSE,$columnNumber = 0){
        $data = array();
        try{
            $this->stmt = $this->con->getConnection()->prepare($this->query);
            
            $this->stmt->execute();
            

            while($row = $this->stmt->fetch()){
                if($columnSet){
                    array_push($data,$row[$columnNumber]);
                }else{
                    array_push($data,$row);
                }
            }

        } catch (\PDOException $ex) {
            echo 'Statement salah '.$ex->getMessage();
        }
        
        return $data;
    }

    function go(){
        $data = array();

        try{
            $this->stmt = $this->con->getConnection()->prepare($this->query);
            
            $this->stmt->execute();
            
            while($row = $this->stmt->fetch()){
                $data[] = $row;
            }
        } catch (\PDOException $ex) {
            echo 'Statement salah '.$ex->getMessage();
        }

        return $data;
    }

    /*
    * trigger untuk aktivitas objek crud tertentu dengan objek lainnya yang ada didalam model
    * $trigger = array(objek => 'save',objek => 'delete')
    */
    public function trigger(array $trigger){

    }
}