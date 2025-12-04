<?php
require_once 'config/Database.php'; 
$db = new Database();
require_once 'controllers/HomeController.php'; // dùng để gọi views/home/index
$controller = new HomeController();
$controller->index();
?>
