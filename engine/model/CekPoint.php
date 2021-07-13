<?php 

class CekPoint extends Model{
	function __construct(){
		$this->initial();
		
		$this->setTable('cek_point');
		$this->setField(['kode_cp','provinsi','kab_kota','titik_point']);
		
		$this->setId('kode_cp');
	}
}

?>