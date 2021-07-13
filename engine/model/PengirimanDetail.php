<?php 

class PengirimanDetail extends Model{
	function __construct(){
		$this->initial();
		
		$this->setTable('pengiriman_detail');
		$this->setField(['kode_pengiriman','tanggal_detail','status_detail','cek_point','jenis_detail','keterangan','nip']);
		
		$this->setId('kode_pengiriman');
	}
}

?>