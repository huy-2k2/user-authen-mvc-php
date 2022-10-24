<?php
?>
<form class="form" method="POST" action="?controller=authen">
    <div class="form-header">
        <img class="form-logo" src="assets/images/logo.png" alt="" />
        <span class="form-title">Đăng nhập</span>
    </div>
    <div class="form-field">
        <div class="form-input">
            <input autocomplete="off" id="email" name="email" placeholder=" " type="text" value="<?php echo $email ?>" />
            <label for="email">email</label>
        </div>
        <span><?php echo $errors['email'] ?></span>
    </div>
    <div class="form-field">
        <div class="form-input">
            <input autocomplete="off" id="password" name="password" placeholder=" " type="password" />
            <label for="password">mật khẩu</label>
        </div>
        <span><?php echo $errors['password'] ?></span>
    </div>
    <button name="submit" value="1" type="submit">Đăng nhập</button>
    <div class="form-redirect">
        <p class="form-redirect-item">bạn chưa có tại khoản? <a class="form-redirect-link" href="?controller=authen&action=sign_up">Đăng ký</a></p>
        <a class="form-redirect-item" href="?controller=authen&action=reset_password">Quên mật khẩu?</a>
    </div>
</form>