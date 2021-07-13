<?php 

class BarangDetail extends Model{
	function __construct(){
		$this->initial();
		
		$this->setTable('barang_detail');
		$this->setField(['kode_barang','nama_barang','status_barang','jenis_barang','jumlah_barang','massa_barang']);
		
		$this->setId('kode_barang');
	}
}

?>