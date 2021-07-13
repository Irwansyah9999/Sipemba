<div class="row bd-thin" id="bx-cari">
    <span class="pad-5px bg-gray bd-radius-br">PENCARIAN</span>

    <div class="row-mg">
        <div class="float-right">
            <button type="button" class="btn-lg btn-danger" id="close-cari">X</button>
        </div><div class="clear-right"></div>
    </div>
    <div class="row-mg">
        <form action="" method="get">
        <select name="tipe" class="form-control-v2">
            <option value="and">AND</option>
            <option value="or">OR</option>
        </select>
        <p>Sebelumnya: <?= $tipe ?></p><br>
        <?php 
            if($atribut['action'] == ''){ ?>
            <!-- barang -->
            <input type="text" name="kode" id="" class="form-control" placeholder="Kode" value="">
        <?php }else if($atribut['action'] == 'detail'){ ?>
            <label for="">Jenis Barang</label>
            <select name="jenis" id="" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
            </select>

            <label for="">Status</label>
            <select name="status" id="" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
            </select>

            <input type="number" name="massa" id="" class="form-control" placeholder="Massa" value="">
        <?php 
            }
        ?>
            <button type="submit" class="btn btn-safe" name="cari">cari</button>
        </form>
    </div>
</div>