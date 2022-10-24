<form class="form" method="POST" action="?controller=authen&action=reset_end">
    <div class="form-header">
        <img class="form-logo" src="assets/images/logo.png" alt="" />
        <span class="form-title">đặt mật khẩu</span>
    </div>
    <div class="form-field">
        <div class="form-input">
            <input autocomplete="off" id="password" name="password" placeholder=" " type="password" />
            <label for="password">mật khẩu mới</label>
        </div>
        <span><?php echo $errors['password'] ?></span>
    </div>
    <p class="form-message">Lấy lại mật khẩu cho tài khoản <strong><?php echo $email ?>, </strong></p>
    <button name="submit" value="1" type="submit">Lấy mật khẩu</button>

</form>