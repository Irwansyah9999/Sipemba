<?php 

class Pengiriman extends Model{
	function __construct(){
		$this->initial();
		
		$this->setTable('pengiriman');
		$this->setField(['kode_pengiriman','tanggal_pengiriman','status_pengiriman','massa_pengiriman','harga_pengiriman','kode_pengirim','kode_penerima','kode_barang']);
		
		$this->setId('kode_pengiriman');
	}
}

?>