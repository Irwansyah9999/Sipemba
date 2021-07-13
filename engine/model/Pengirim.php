<?php 

class Pengirim extends Model{
	function __construct(){
		$this->initial();
		
		$this->setTable('pengirim');
		$this->setField(['kode_pengirim','nama_pengirim','telepon_Pengirim','alamat_Pengirim']);
		$this->setId('kode_pengirim');
	}
}

?>