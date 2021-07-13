<?php 

class Karyawan extends Model{
	function __construct(){
		$this->initial();
		
		$this->setTable('karyawan');
		$this->setField(['nip','nama_karyawan','tempat_lahir_karyawan','tanggal_lahir_karyawan','jenis_kelamin_karyawan','divisi_karyawan','jabatan_karyawan','email_karyawan','telepon_karyawan','alamat_karyawan']);
		
		$this->setId('nip');
	}
}

?>