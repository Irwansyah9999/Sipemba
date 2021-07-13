<div class="row bd-thin" id="bx-cari">
    <span class="pad-5px bg-gray bd-radius-br">PENCARIAN</span>

    <div class="row-mg">
        <div class="float-right">
            <button type="button" class="btn-lg btn-danger" id="close-cari">X</button>
        </div><div class="clear-right"></div>
    </div>
    <div class="row-mg">
        <form action="aksi/search.php" method="get">
            <!-- penerima -->
            <select name="tipe" class="form-control-v2">
                <option value="and">AND</option>
                <option value="or">OR</option>
            </select>
            <p>Sebelumnya: <?= $tipe ?></p><br>

            <input type="text" name="kode_pe" id="" class="form-control" placeholder="Kode">

            <input type="text" name="nama_pe" id="" class="form-control" placeholder="Nama">

            <input type="text" name="telepon_pe" id="" class="form-control" placeholder="Telepon">

            <label for="">Provinsi</label>
            <select name="provinsi_pe" id="" class="form-control">
                <option value="">-pilih-</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>

            <label for="">Kota/Kab</label>
            <select name="kotkab_pe" id="" class="form-control">
                <option value="">-pilih-</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>

            <button type="submit" class="btn btn-safe" name="cari">cari</button>
        </form>
    </div>
</div>