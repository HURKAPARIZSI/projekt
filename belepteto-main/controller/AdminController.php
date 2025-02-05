<?php
require_once '../model/Admin.php'; 

$adminModel = new Admin(); 


$admins = $adminModel->getAllUsers();

echo "<pre>";
print_r($admins);
echo "</pre>";
?>