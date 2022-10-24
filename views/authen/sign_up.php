<?php
?>
<form class="form" method="POST" action="?controller=authen&action=sign_up">
    <div class="form-header">
        <img class="form-logo" src="assets/images/logo.png" alt="" />
        <span class="form-title">Đăng ký</span>
    </div>
    <div class="form-field">
        <div class="form-input">
            <input autocomplete="off" id="fullname" name="fullname" placeholder=" " type="text" value="<?php echo $fullname ?>" />
            <label for="fullname">fullname</label>
        </div>
        <span><?php echo $errors['fullname'] ?></span>
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
    <button name="submit" value="1" type="submit">Đăng ký</button>
    <div class="form-redirect">
        <p>bạn đã có tài khoản? <a class="form-redirect-link" href="?controller=authen">Đăng nhập</a></p>
    </div>
</form>
<script src="assets/js/main.js"></script>