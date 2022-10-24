<?php
require_once 'controllers/base_controller.php';
require_once 'lib/validate_lib.php';
require_once 'models/User.php';
require_once 'lib/mail_lib.php';
require_once 'lib/string_url.php';
require 'config/server_config.php';
class AuthenController extends BaseController
{
    function main()
    {
        $data = ['errors' => ['email' => '', 'password' => ''], 'email' => ''];

        if (isset($_POST['submit'])) {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $data['errors']['email'] = validate_email($email) ?? '';
            $data['errors']['password'] = validate_password($password) ?? '';
            $data['email'] = $email;
            if (!$data['errors']['email'] && !$data['errors']['password']) {
                $response = User::check_user_valid($email, md5($password));
                if (!$response) {
                    $data['errors']['email'] = $data['errors']['password'] = 'email hoạc mật khẩu không tồn tại';
                } else {
                    $_SESSION['user_email'] = $response['email'];
                    header("Location: ?");
                    print_r($response);
                }
            }
        }
        $this->render('sign_in', $data);
    }

    function sign_up()
    {
        $data = ['errors' => ['email' => '', 'password' => '', 'fullname' =>  ''], 'email' => '', 'fullname' =>  ''];
        $view = 'sign_up';

        if (isset($_POST['submit'])) {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $fullname = $_POST['fullname'] ?? '';

            $data = ['errors' => ['email' => validate_email($email) ?? '', 'password' => validate_password($password) ?? '', 'fullname' => validate_empty($fullname, 'fullname') ?? ''], 'email' => $email ?? '', 'fullname' => $fullname ?? ''];
            if (!$data['errors']['email'] && !$data['errors']['password'] && !$data['errors']['fullname']) {

                $response = User::check_email_existed($email);
                if ($response) {
                    if ($response['is_active'] == 1) {
                        $data['errors']['email'] = 'email đã tồn tại';
                    } else {
                        User::remove_user($email);
                    }
                }
                if (!$response || !$response['is_active']) {
                    $token = md5($email . $fullname . time());
                    $link = SERVER_NAME . "?controller=authen&action=active&email=$email&token=$token";
                    User::insert_user(capitalize_string($fullname), $email, md5($password), $token);
                    send_email_active_account($email, $fullname, $link);
                    $view = 'active_account';
                }
            }
        }
        $this->render($view, $data);
    }

    function active()
    {
        $token = $_GET['token'] ?? '';
        $email = $_GET['email'] ?? '';
        if ($token && $email) {
            $response = User::check_valid_token($email, $token);
            if ($response) {
                User::active_account($email);
                $_SESSION['user_email'] = $email;
                header("Location: ?");
            }
        }
    }

    function sign_out()
    {
        unset($_SESSION['user_email']);
        header('Location: ?controller=authen');
    }

    function change_password()
    {
        $data = ['errors' => ['old_password' => '', 'new_password' => '']];

        if (isset($_POST['submit'])) {
            $old_password = $_POST['old_password'] ?? '';
            $new_password = $_POST['new_password'] ?? '';
            $data['errors']['old_password'] = validate_password($old_password) ?? '';
            $data['errors']['new_password'] = validate_password($new_password) ?? '';
            if (!$data['errors']['old_password'] && !$data['errors']['new_password']) {
                $response = User::check_user_valid($_SESSION['user_email'], md5($old_password));
                print_r($response);
                if (!$response) {
                    $data['errors']['old_password'] = $data['errors']['new_password'] = 'mật khẩu cũ không đúng';
                } else {
                    User::update_password($_SESSION['user_email'], md5($new_password));
                    header('Location: ?');
                }
            }
        }
        $this->render('change_password', $data);
    }

    function reset_password()
    {
        $data = ['errors' => ['email' => ''], 'email' => ''];
        $view = 'reset_password';
        if (isset($_POST['submit'])) {
            $email = $_POST['email'] ?? '';
            $data['errors']['email'] = validate_email($email) ?? '';
            $data['email'] = $email;
            if (!$data['errors']['email']) {
                $user = User::check_email_existed($email);
                if ($user && $user['is_active'] == 1) {
                    $token = md5($email . time());
                    $link = SERVER_NAME . "?controller=authen&action=active_reset&email=$email&token=$token";
                    User::update_token_reset_password($email, $token);
                    send_email_active_reset($email, $user['fullname'], $link);
                    $view = 'active_reset';
                } else {
                    $data['errors']['email'] = 'Tài khoản không tồn tại';
                }
            }
        }
        $this->render($view, $data);
    }
    function active_reset()
    {
        $email = $_GET['email'];
        $token = $_GET['token'];
        $user = User::check_valid_token($email, $token);
        if ($user && $user['is_reseting'] == 1) {
            $_SESSION['user_email_reset'] = $email;
            $this->render('reset_password_end', ['email' => $email, 'errors' => ['password' => '']]);
        }
    }
    function reset_end()
    {
        $data = ['errors' => ['password' => ''], 'email' => $_SESSION['user_email_reset']];

        if (isset($_POST['submit'])) {
            $password = $_POST['password'] ?? '';
            $data['errors']['password'] = validate_password($password) ?? '';
            if (!$data['errors']['password']) {
                User::update_password_reset($_SESSION['user_email_reset'], md5($password));
                $_SESSION['user_email'] = $_SESSION['user_email_reset'];
                unset($_SESSION['user_email_reset']);
                header('Location: ?');
            }
        }
        $this->render('reset_password_end', $data);
    }
}
