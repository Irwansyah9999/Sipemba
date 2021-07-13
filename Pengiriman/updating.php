<?php 
$id = $view->get('id');
$datapengiriman = $pengiriman->select($pengiriman->getTable())->where()->comparing('kode_pengiriman',$id)->goData();
?>
<!-- Box update cek point pengiriman -->
<div class="box-lg bd-shadow">
    <div class="header">
        Lakukan Update Cek Point

        <div class="float-right">
            <button type="button" class="btn-lg btn-danger" onclick="onLocation('?action')">X</button>
        </div><div class="clear-right"></div>
    </div>
    <div class="body">
        <form action="aksi/update.php" method="post">

            <div class="ds-flex">
                <!-- pengiriman -->
                <fieldset>
                    <legend><h4>Update Cek Point Pengiriman</h4></legend>
                    <input type="text" name="kode" id="" class="form-control" placeholder="Kode" value="<?= $id ?>" readonly>

                    <label for="">Tanggal</label>
                    <input type="datetime" name="tanggal" id="" class="form-control" placeholder="Tanggal" value="<?= date('Y-m-d H:i:s') ?>" readonly>

                    <label for="">Status Detail</label>
                    <select name="status" id="" class="form-control">
                        <option value="">-Pilih-</option>
                        <option value="mulai">Mulai kirim</option>
                        <option value="transit">kiriman transit</option>
                        <option value="transit">Selesai</option>
                    </select>

                    <label for="">Kab Kota</label>
                    <select name="provinsi" id="" class="form-control">
                        <option value="">-Pilih Kab Kota-</option>
                        <?php
                        for ($i=0; $i < count($dataProvinsi); $i++) { ?>
                            <option value="<?= $dataProvinsi[$i]['provinsi'].'-'.$dataProvinsi[$i]['kab_kota'] ?>"><?= $dataProvinsi[$i]['provinsi'].' - '.$dataProvinsi[$i]['kab_kota'] ?></option>    
                        <?php
                        }
                        ?>
                    </select>

                    <label for="">Jenis Pengiriman</label>
                    <select name="jenis" id="" class="form-control">
                        <option value="">-Pilih-</option>
                        <option value="truk">Truk</option>
                        <option value="Kapal">Kapal</option>
                    </select>

                    <textarea name="keterangan" class="form-control" id="" cols="30" rows="10" placeholder="Keterangan"></textarea>

                    <input type="text" name="nip" id="" class="form-control" placeholder="NIP(isi berdasarkan karyawan yang menambahkan)" value="<?= $view->getSession('id') ?>" readonly>
                </fieldset>
            </div>

            <button type="submit" class="btn btn-safe" name="perbarui">PERBARUI</button>
        </form>
    </div>
</div>
<!-- end  -->                