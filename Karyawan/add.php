<!-- Box tambah KARYAWAN -->
<div class="box-lg bd-shadow" id="add">
    <div class="header">
        TAMBAH KARYAWAN

        <div class="float-right">
            <button type="button" class="btn-lg btn-danger" onclick="onLocation('?action')">X</button>
        </div><div class="clear-right"></div>
        
    </div>
    <div class="body">
        <form action="aksi/save.php" method="post" onsubmit="">
            <!-- KARYAWAN -->

            <input type="text" name="kode" id="" class="form-control" placeholder="Kode" value="">

            <input type="text" name="nama" class="form-control" placeholder="Nama" value="">

            <div class="form-grouping">
                <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir">
                
                <input type="date" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir">
            </div>

            <select name="jenis_kelamin" id="" class="form-control">
                <option value="">-Pilih-</option>
                <option value="L">Laki - Laki</option>
                <option value="P">Perempuan</option>
            </select>

            <select name="divisi" class="form-control">
                <option value="">-Pilih-</option>
                <option value="admin">Admin</option>
                <option value="pengantar">Pengantar</option>
            </select>

            <select name="jabatan" class="form-control">
                <option value="">-Pilih-</option>
                <option value="kb">Kepala Bagian</option>
                <option value="karyawan">karyawan</option>
            </select>
            
            <input type="email" name="email" id="" class="form-control" placeholder="Email">

            <input type="text" name="telepon" id="" class="form-control" placeholder="Telepon">
            
            <textarea name="alamat" id="" cols="30" rows="10" class="form-control" placeholder="Alamat"></textarea>

            <button type="submit" class="btn btn-safe" name="tambah">TAMBAH</button>
        </form>
    </div>
</div>
<!--  end -->