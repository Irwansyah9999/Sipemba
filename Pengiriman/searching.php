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

            <input type="text" name="kode" id="" class="form-control" placeholder="Kode">

        <?php
            if($atribut['action'] == ''){ ?>

            <label for="">Tanggal Pengiriman</label>
            <input type="datetime" name="tanggal" id="" class="form-control" placeholder="Tanggal(yyyy-mm-dd hh:ii:ss)" value="">

            <label for="">Status</label>
            <select name="status" id="" class="form-control">
                <option value="diproses">Diproses</option>
                <option value="mulai">Mulai</option>
                <option value="transit">Transit</option>
                <option value="selesai">selesai</option>
            </select>

            <input type="number" name="massa" id="" class="form-control" placeholder="Massa">

            <input type="text" name="kode_p" id="" class="form-control" placeholder="Kode pengiriman">

            <input type="text" name="kode_pe" id="" class="form-control" placeholder="Kode Penerima">

            <input type="text" name="kode_b" id="" class="form-control" placeholder="Kode Barang">

            <?php
            }else if($atribut['action'] == 'detail'){ ?>
            
            <label for="">Tanggal Pengiriman</label>
            <input type="datetime" name="tanggal" id="" class="form-control" placeholder="Tanggal(yyyy-mm-dd hh:ii:ss)" value="">

            <label for="">Provinsi</label>
            <select name="provinsi" id="" class="form-control">
                <option value="">-Pilih-</option>
                <option value="">Diproses</option>
                <option value="">Mulai</option>
                <option value="">Transit</option>
                <option value="">selesai</option>
            </select>

            <label for="">Kota/Kab</label>
            <select name="kotkab" id="" class="form-control">
                <option value="">-Pilih-</option>
                <option value="">Mulai</option>
                <option value="">Transit</option>
                <option value="">selesai</option>
            </select>

            <label for="">Jenis</label>
            <select name="jenis" id="" class="form-control">
                <option value="">-Pilih-</option>
                <option value="">Truk</option>
                <option value="">Kapal</option>
            </select>

            <input type="text" name="keterangan" id="" class="form-control" placeholder="Keterangan">

            <input type="text" name="nip" id="" class="form-control" placeholder="Nip">

        <?php 
            }
        ?>

            <button type="submit" class="btn btn-safe" name="cari">cari</button>
        </form>
    </div>
</div>