<!-- Box tambah KARYAWAN -->
<div class="box-lg bd-shadow" id="add">
    <div class="header">
        TAMBAH CEK POINT

        <div class="float-right">
            <button type="button" class="btn-lg btn-danger" onclick="onLocation('?action')">X</button>
        </div><div class="clear-right"></div>
        
    </div>
    <div class="body">
        <form action="aksi/save.php" method="post" onsubmit="">
            <!-- Cek Point -->

            <input type="text" name="kode" id="" class="form-control" placeholder="Kode" value="">

            <input type="text" name="provinsi" class="form-control" placeholder="Provinsi" value="">
            
            <input type="text" name="kabkot" id="" class="form-control" placeholder="Kab/Kota">

            <input type="text" name="tikpon" id="" class="form-control" placeholder="Titik Point">

            <button type="submit" class="btn btn-safe" name="tambah">TAMBAH</button>
        </form>
    </div>
</div>
<!--  end -->