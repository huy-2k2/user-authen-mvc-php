<?php
session_start();
require_once('connection.php');

$controller = $_GET['controller']  ?? 'page';
$action = $_GET['action'] ?? 'main';
require_once('routes.php');
