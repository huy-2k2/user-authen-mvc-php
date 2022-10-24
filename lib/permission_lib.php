<?php
function check_was_sign_in($url = null)
{
    $url = $url ?? '?controller=authen&action=main';
    if (!isset($_SESSION['user_email'])) {
        header('Location: ' . $url);
    }
}
