<?php
require_once __DIR__ . '/../includes/functions.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
    delete_product($id);
}
header('Location: /admin/index.php');
exit;
