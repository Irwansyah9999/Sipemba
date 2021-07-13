<div class="row bd-thin" id="bx-cari">
    <span class="pad-5px bg-gray bd-radius-br">PENCARIAN</span>

    <div class="row-mg">
        <div class="float-right">
            <button type="button" class="btn-lg btn-danger" id="close-cari">X</button>
        </div><div class="clear-right"></div>
    </div>
    <div class="row-mg">
        <form action="aksi/search.php" method="get">
            <!-- Cek Point -->

            <select name="tipe" class="form-control-v2">
                <option value="and">AND</option>
                <option value="or">OR</option>
            </select>
            <p>Sebelumnya: <?= $tipe ?></p><br>

            <input type="text" name="kode" id="" class="form-control" placeholder="Kode" value="">

            <input type="text" name="provinsi" class="form-control" placeholder="Provinsi" value="">
            
            <input type="text" name="kabkot" id="" class="form-control" placeholder="Kab/Kota">

            <input type="text" name="tikpon" id="" class="form-control" placeholder="Titik Point">

            <button type="submit" class="btn btn-safe" name="cari">cari</button>
        </form>
    </div>
</div>