<?php 

class Penerima extends Model{
	function __construct(){
		$this->initial();
		
		$this->setTable('penerima');
		$this->setField(['kode_penerima','nama_penerima','telepon_penerima','alamat_penerima']);
		$this->setId('kode_penerima');
	}
}

?>