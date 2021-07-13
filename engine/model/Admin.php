<?php 

class Admin extends Model{
	function __construct(){
		$this->initial();
		
		$this->setTable('admin');
		$this->setField(['kode_admin','nama_admin','tempat_lahir_admin','tanggal_lahir_admin','email_admin','no_telepon_admin','alamat_admin']);
		
		$this->setId('kode_admin');
	}
}

?>