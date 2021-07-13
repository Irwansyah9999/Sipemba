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
            <div class="row-mg">
                <input type="number" name="jumlah" id="jumlah" class="form-control-nl" placeholder="Jumlah"> <button type="button" class="btn btn-safe">Tambah</button>
            </div>
            <table>
                <tbody id="table-cp">
                    <tr>
                        <td class="pad-5px"><input type="text" name="kode_1" id="" class="form-control" placeholder="Kode" value=""></td>
                        <td class="pad-5px"><input type="text" name="provinsi_1" class="form-control" placeholder="Provinsi" value=""></td>
                        <td class="pad-5px"><input type="text" name="kabkot_1" id="" class="form-control" placeholder="Kab/Kota"></td>
                        <td class="pad-5px"><input type="text" name="tikpon_1" id="" class="form-control" placeholder="Titik Point"></td>
                    </tr>
                    <tr>
                        <td class="pad-5px"><input type="text" name="kode_2" id="" class="form-control" placeholder="Kode" value=""></td>
                        <td class="pad-5px"><input type="text" name="provinsi_2" class="form-control" placeholder="Provinsi" value=""></td>
                        <td class="pad-5px"><input type="text" name="kabkot_2" id="" class="form-control" placeholder="Kab/Kota"></td>
                        <td class="pad-5px"><input type="text" name="tikpon_2" id="" class="form-control" placeholder="Titik Point"></td>
                    </tr>
                    <tr>
                        <td class="pad-5px"><input type="text" name="kode_3" id="" class="form-control" placeholder="Kode" value=""></td>
                        <td class="pad-5px"><input type="text" name="provinsi_3" class="form-control" placeholder="Provinsi" value=""></td>
                        <td class="pad-5px"><input type="text" name="kabkot_3" id="" class="form-control" placeholder="Kab/Kota"></td>
                        <td class="pad-5px"><input type="text" name="tikpon_3" id="" class="form-control" placeholder="Titik Point"></td>
                    </tr>
                </tbody>
            </table>

            <button type="submit" class="btn btn-safe" name="tambah">TAMBAH</button>
        </form>
    </div>
</div>
<!--  end -->
<script>
    
</script>