<?php

function validate_empty($value, $field = 'trường này')
{
    if (empty($value))
        return 'Vui lòng nhập ' . $field;
    return false;
}

function validate_email($email)
{
    if (validate_empty($email))
        return validate_empty($email, 'email');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        return 'Vui lòng nhập email hợp lệ';
}

function validate_password($password)
{
    if (validate_empty($password))
        return validate_empty($password, 'password');
    if (strlen($password) < 6)
        return 'Mật khẩu phải lớn hơn 6 ký tự';
}
