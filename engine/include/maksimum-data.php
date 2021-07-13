<form action="" method="get">
    <label>Tampilkan</label>
    <select name="show" id="" class="form-control-nl">
        <option value="5" onclick="onLocation('?maxLength=5')" <?php if($atribut['maxLength'] == 5){ ?> selected <?php } ?>>5</option>
        <option value="10" onclick="onLocation('?maxLength=10')" <?php if($atribut['maxLength'] == 10){ ?> selected <?php } ?>>10</option>
        <option value="20" onclick="onLocation('?maxLength=20')" <?php if($atribut['maxLength'] == 20){ ?> selected <?php } ?>>20</option>
        <option value="30" onclick="onLocation('?maxLength=30')" <?php if($atribut['maxLength'] == 30){ ?> selected <?php } ?>>30</option>
    </select>
</form>