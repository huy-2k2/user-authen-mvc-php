<?php

use LDAP\Result;

class User
{
    public static function check_user_valid($email, $password)
    {
        $conn = DB::get_connection();
        $sql = "SELECT * FROM user WHERE user.email = '$email' AND user.password = '$password' AND user.is_active = '1'";
        $result = $conn->query($sql);
        return $result->fetch_assoc();
    }

    public static function check_email_existed($email)
    {
        $conn = DB::get_connection();
        $sql = "SELECT * FROM user WHERE user.email = '$email'";
        $result = $conn->query($sql);
        return $result->fetch_assoc();
    }
    public static function insert_user($fullname, $email, $password, $token)
    {
        $conn = DB::get_connection();
        $sql = "INSERT INTO user (fullname, email, password, token)
        VALUES ('$fullname', '$email', '$password', '$token')";
        $result = $conn->query($sql);
        return !!$result;
    }

    public static function check_valid_token($email, $token)
    {
        $conn = DB::get_connection();
        $sql = "SELECT * FROM user WHERE user.email = '$email' AND user.token = '$token'";
        $result = $conn->query($sql);
        return $result->fetch_assoc();
    }

    public static function active_account($email)
    {
        $conn = DB::get_connection();
        $sql = "UPDATE user SET is_active = '1' WHERE email='$email'";
        $result = $conn->query($sql);
        return !!$result;
    }

    public static function remove_user($email)
    {
        $conn = DB::get_connection();
        $sql = "DELETE FROM user WHERE email='$email'";
        $result = $conn->query($sql);
        return !!$result;
    }
    public static function update_password($email, $new_password)
    {
        $conn = DB::get_connection();
        $sql = "UPDATE user SET password = '$new_password' WHERE email = '$email'";
        $result = $conn->query($sql);
        return !!$result;
    }
    public static function update_password_reset($email, $password)
    {
        self::update_password($email, $password);
        $conn = DB::get_connection();
        $sql = "UPDATE user SET is_reseting = '0' WHERE email = '$email'";
        $result = $conn->query($sql);
        return !!$result;
    }
    public static function update_token_reset_password($email, $token)
    {
        $conn = DB::get_connection();
        $sql = "UPDATE user SET token = '$token', is_reseting = '1' WHERE email = '$email'";
        $result = $conn->query($sql);
        return !!$result;
    }
}
