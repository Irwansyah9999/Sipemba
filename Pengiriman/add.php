<?php 
    $jumlah = $view->get('jumlah_barang','');
    $cp = $view->get('kode_cp');
?>

<!-- Box tambah pengiriman -->
<div class="box-lg bd-shadow">
    <div class="header">
        Lakukan Pengiriman

        <div class="float-right">
            <button type="button" class="btn-lg btn-danger" onclick="onLocation('?action')">X</button>
        </div><div class="clear-right"></div>
    </div>
    <div class="body">
        <form action="aksi/save.php" method="post">
            <input type="text" name="jumlah" id="" value="<?= $jumlah ?>" class="ds-none">
            <div class="row-mg">
                <!-- pengiriman -->
                <fieldset>
                    <legend><h4>Pengiriman(Bisa Diganti juga dengan kode )</h4></legend>
                    <input type="text" name="kode" id="" class="form-control" placeholder="Kode" value="<?= "P".time() ?>">

                    <label for="">Tanggal</label>
                    <input type="datetime" name="tanggal" id="" class="form-control" placeholder="Tanggal(yyyy-mm-dd hh:ii:ss)" value="<?= date('Y-m-d H:i:s') ?>" readonly>

                    <input type="text" name="status" id="" class="form-control ds-none" placeholder="Status" value="diproses">

                    <label for="">Harga Pengiriman</label>
                    <input type="number" name="harga" id="" class="form-control" placeholder="Harga Penawaran(Rupiah)" value="">
                </fieldset>
            </div>
            <div class="ds-flex">
                <!-- penerima -->
                <fieldset>
                    <legend><h4>Penerima</h4></legend>

                    <input type="text" name="kode_pe" id="" class="form-control" placeholder="Kode" value="<?= 'kpe'.time() ?>" readonly>

                    <input type="text" name="nama_pe" id="" class="form-control" placeholder="Nama Perusahaan/Perorangan">

                    <input type="text" name="telepon_pe" id="" class="form-control" placeholder="Telepon">

                    <label for="">Kab Kota</label>
                    <select name="provinsi_p" id="" class="form-control">
                        <option value="">-Pilih Kab Kota-</option>
                        <?php
                        for ($i=0; $i < count($dataProvinsi); $i++) { ?>
                            <option value="<?= $dataProvinsi[$i]['provinsi'].'-'.$dataProvinsi[$i]['kab_kota'] ?>"><?= $dataProvinsi[$i]['provinsi'].' - '.$dataProvinsi[$i]['kab_kota'] ?></option>    
                        <?php
                        }
                        ?>
                    </select>

                    <textarea name="alamat_pe" class="form-control" id="" cols="30" rows="10" placeholder="Alamat"></textarea>

                </fieldset>

                <!-- pengirim -->
                <fieldset>
                    <legend><h4>Pengirim</h4></legend>

                    <input type="text" name="kode_p" id="" class="form-control" placeholder="Kode" value="<?= 'kp'.time() ?>" readonly>

                    <input type="text" name="nama_p" id="" class="form-control" placeholder="Nama Perusahaan/Perorangan">

                    <input type="text" name="telepon_p" id="" class="form-control" placeholder="Telepon">

                    <label for="">Kab Kota</label>
                    <select name="provinsi_p" id="" class="form-control">
                        <option value="">-Pilih Kab Kota-</option>
                        <?php
                        for ($i=0; $i < count($dataProvinsi); $i++) { ?>
                            <option value="<?= $dataProvinsi[$i]['provinsi'].'-'.$dataProvinsi[$i]['kab_kota'] ?>"><?= $dataProvinsi[$i]['provinsi'].' - '.$dataProvinsi[$i]['kab_kota'] ?></option>    
                        <?php
                        }
                        ?>
                    </select>

                    <textarea name="alamat_p" class="form-control" id="" cols="30" rows="10" placeholder="Alamat"></textarea>
                </fieldset>
            </div>
            <div class="row-mg">
                <fieldset>
                    <legend><h4>Barang</h4></legend>

                    <input type="text" name="kode_barang" id="" class="form-control" placeholder="Kode Barang">

                    <textarea name="keterangan_barang" class="form-control" id="" cols="30" rows="10" placeholder="Keterangan"></textarea>
                <?php
                $count=0;
                for ($i=0; $i < $jumlah; $i++) { ?>
                    <!-- barang -->
                    <fieldset>
                        <legend><h4>Barang ke-<?=$i + 1?></h4></legend>
                            <label for="">Jumlah Barang</label>
                            <input type="number" name="jumlah_barang_<?=$i?>" id="" class="form-control" placeholder="jumlah">

                            <input type="text" name="nama_barang_<?=$i?>" id="" class="form-control" placeholder="Nama">

                            <input type="text" name="status_barang_<?=$i?>" id="" class="form-control" placeholder="Status">

                            <label for="">Jenis Barang</label>
                            <select name="jenis_barang_<?=$i?>" id="" class="form-control">
                                <option value="perkebunan">Perkebunan</option>
                                <option value="Texstil">Texstil</option>
                                <option value="dll">Dan Lainnya</option>
                            </select>

                            <input type="number" name="massa_barang_<?=$i?>" id="" class="form-control" placeholder="massa">
                    </fieldset>

                <?php 
                $count++;
                }
                ?>
                </fieldset>
            </div>

            <button type="submit" class="btn btn-safe" name="tambah">TAMBAH</button>
        </form>
    </div>
</div>
<!--  end -->