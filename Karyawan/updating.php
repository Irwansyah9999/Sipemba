<?php 
$id = $view->get('id');
$dataKaryawan = $karyawan->select($karyawan->getTable())->where()->comparing('nip',$id)->goData();
?>
<!-- Box update KARYAWAN  -->
<div class="box-lg bd-shadow" id="pb">
    <div class="header">
        PERBARUI KARYAWAN DENGAN NIP <?= $id ?>

        <div class="float-right">
            <button type="button" class="btn-lg btn-danger" onclick="onLocation('?action')">X</button>
        </div><div class="clear-right"></div>
    </div>
    <div class="body">
        <form action="aksi/update.php" method="post">
            <!-- KARYAWAN -->

            <input type="text" name="kode_p" id="" class="form-control" placeholder="Kode" value="<?= $id ?>" readonly>

            <input type="text" name="nama_p" id="" class="form-control" placeholder="Nama" value="<?= $dataKaryawan[0]['nama_karyawan'] ?>">

            <div class="form-grouping">
                <input type="text" name="tempat_lahir_p" class="form-control" placeholder="Tempat Lahir" value="<?= $dataKaryawan[0]['tempat_lahir_karyawan'] ?>">
                
                <input type="date" name="tanggal_lahir_p" class="form-control" placeholder="Tanggal Lahir" value="<?= $dataKaryawan[0]['tanggal_lahir_karyawan'] ?>">
            </div>

            <select name="jenis_kelamin_p" id="" class="form-control">
                <option value="">-Pilih-</option>
                <option value="L" <?php if($dataKaryawan[0]['jenis_kelamin_karyawan'] == 'L'){ ?> selected <?php  } ?>>Laki - Laki</option>
                <option value="P" <?php if($dataKaryawan[0]['jenis_kelamin_karyawan'] == 'P'){ ?> selected <?php  } ?>>Perempuan</option>
            </select>

            <select name="divisi_p" class="form-control">
                <option value="">-Pilih-</option>
                <option value="admin" <?php if($dataKaryawan[0]['divisi_karyawan'] == 'admin'){ ?> selected <?php  } ?>>Admin</option>
                <option value="pengantar" <?php if($dataKaryawan[0]['divisi_karyawan'] == 'pengantar'){ ?> selected <?php  } ?>>Pengantar</option>
            </select>

            <select name="jabatan_p" class="form-control">
                <option value="">-Pilih-</option>
                <option value="kb" <?php if($dataKaryawan[0]['jabatan_karyawan'] == 'kb'){ ?> selected <?php  } ?>>Kepala Bagian</option>
                <option value="karyawan" <?php if($dataKaryawan[0]['jabatan_karyawan'] == 'karyawan'){ ?> selected <?php } ?>>Karyawan</option>
            </select>
            
            <input type="email" name="email_p" id="" class="form-control" placeholder="Email" value="<?= $dataKaryawan[0]['email_karyawan'] ?>">

            <input type="text" name="telepon_p" id="" class="form-control" placeholder="Telepon" value="<?= $dataKaryawan[0]['email_karyawan'] ?>">
            
            <textarea name="alamat_p" id="" cols="30" rows="10" class="form-control" placeholder="Alamat"><?= $dataKaryawan[0]['alamat_karyawan'] ?></textarea>

            <button type="submit" class="btn btn-safe" name="perbarui">PERBARUI</button>
        </form>
    </div>
</div>
<!-- end  -->        