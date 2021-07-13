<?php 

class Barang extends Model{
	function __construct(){
		$this->initial();
		
		$this->setTable('barang');
		$this->setField(['kode_barang','keterangan_barang']);
		
		$this->setId('kode_barang');
	}
}

?>