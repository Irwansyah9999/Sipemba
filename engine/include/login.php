<!-- login -->
<div class="box-lg bd-shadow">
    <div class="header">
        Silahkan Login
    </div>
    <div class="body">
        <?php //include_once('../engine/include/notif.php') ?>

        <form action="login/login.php" method="post">
            <input type="text" name="username" id="" class="form-control" placeholder="Username">

            <input type="password" name="password" id="" class="form-control" placeholder="Password">

            <input type="checkbox" name="akses" id="" class="choice"> Setuju untuk login

            <br>
            <div class="ds-flex jc-end">
                <button type="submit" name="login" class="btn btn-safe">Login</button>
            </div>
        </form>
    </div>
</div>