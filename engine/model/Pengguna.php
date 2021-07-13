<?php 

class Pengguna extends Model{
	function __construct(){
		$this->initial();
		
		$this->setTable('pengguna');
		$this->setField(['kode_pengguna','nama_pengguna','username','password','akses_pengguna','akses_pembuatan']);
		
		$this->setId('kode_pengguna');
	}
}

?>