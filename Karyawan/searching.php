<div class="row bd-thin" id="bx-cari">
    <span class="pad-5px bg-gray bd-radius-br">PENCARIAN</span>

    <div class="row-mg">
        <div class="float-right">
            <button type="button" class="btn-lg btn-danger" id="close-cari">X</button>
        </div><div class="clear-right"></div>
    </div>
    <div class="row-mg">
        <form action="aksi/search.php" method="get">
            <!-- KARYAWAN -->
            <select name="tipe" class="form-control-v2">
                <option value="and">AND</option>
                <option value="or">OR</option>
            </select>
            <p>Sebelumnya: <?= $tipe ?></p><br>

            <input type="text" name="kode" id="" class="form-control" placeholder="Kode" value="">

            <input type="text" name="nama" id="" class="form-control" placeholder="Nama" value="">

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

            <button type="submit" class="btn btn-safe" name="cari">cari</button>
        </form>
    </div>
</div>