<?php
if (!isset($pageTitle)) {
    $pageTitle = 'IT Shop';
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>
<header class="site-header">
    <div class="container header-grid">
        <div class="brand">IT Shop</div>
        <nav>
            <a href="/index.php">Rólunk</a>
            <a href="/products.php">Termékek</a>
            <a href="/order.php">Rendelés</a>
            <a href="/contact.php">Kapcsolat</a>
            <a href="/admin/index.php">Admin</a>
        </nav>
    </div>
</header>
<main class="container">
