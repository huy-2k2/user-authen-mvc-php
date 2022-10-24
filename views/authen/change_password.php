<?php
require_once 'views/layout/header.php';
?>
<form class="form" method="POST" action="?controller=authen&action=change_password">
    <div class="form-header">
        <img class="form-logo" src="assets/images/logo.png" alt="" />
        <span class="form-title">Đổi mật khẩu</span>
    </div>
    <div class="form-field">
        <div class="form-input">
            <input autocomplete="off" id="old_password" name="old_password" placeholder=" " type="password" />
            <label for="old_password">mật khẩu cũ</label>
        </div>
        <span><?php echo $errors['old_password'] ?></span>
    </div>
    <div class="form-field">
        <div class="form-input">
            <input autocomplete="off" id="new_password" name="new_password" placeholder=" " type="password" />
            <label for="new_password">mật khẩu mới</label>
        </div>
        <span><?php echo $errors['new_password'] ?></span>
    </div>

    <button name="submit" value="1" type="submit">đổi mật khẩu</button>
</form>