<form class="form" method="POST" action="?controller=authen&action=reset_password">
    <div class="form-header">
        <img class="form-logo" src="assets/images/logo.png" alt="" />
        <span class="form-title">Forgot pasword</span>
    </div>
    <div class="form-field">
        <div class="form-input">
            <input autocomplete="off" id="email" name="email" placeholder=" " type="text" value="<?php echo $email ?>" />
            <label for="email">email</label>
        </div>
        <span><?php echo $errors['email'] ?></span>
    </div>

    <button name="submit" value="1" type="submit">Lấy mật khẩu</button>

</form>
<script src="assets/js/main.js"></script>