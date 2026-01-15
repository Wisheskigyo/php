<?php
require_once __DIR__ . '/../includes/functions.php';
$products = get_products();
$orders = get_orders();
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | IT Shop</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body>
<header>
    <div class="container">
        <nav>
            <a href="/admin/index.php">Kezdőlap</a>
            <a href="/admin/product_form.php">Új termék</a>
            <a href="/index.php">Vissza a főoldalra</a>
            <a href="/admin/logout.php">Kijelentkezés</a>
        </nav>
    </div>
</header>
<div class="container">
    <h1>Termékek</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Név</th>
                <th>Kategória</th>
                <th>Ár</th>
                <th>Készlet</th>
                <th>Műveletek</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo htmlspecialchars($product['name']); ?></td>
                <td><?php echo htmlspecialchars($product['category']); ?></td>
                <td><?php echo number_format((float)$product['price'], 0, ',', ' '); ?> Ft</td>
                <td><?php echo (int)$product['stock']; ?></td>
                <td>
                    <a class="btn secondary" href="/admin/product_form.php?id=<?php echo (int)$product['id']; ?>">Szerkeszt</a>
                    <a class="btn danger" href="/admin/product_delete.php?id=<?php echo (int)$product['id']; ?>" onclick="return confirm('Biztosan törli?');">Törlés</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Rendelések</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Termék</th>
                <th>Vevő</th>
                <th>Mennyiség</th>
                <th>Elérhetőség</th>
                <th>Cím</th>
                <th>Dátum</th>
                <th>Művelet</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?php echo htmlspecialchars($order['product_name'] ?? 'Ismeretlen'); ?></td>
                <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                <td><?php echo (int)$order['quantity']; ?></td>
                <td>
                    <?php echo htmlspecialchars($order['email']); ?><br>
                    <?php echo htmlspecialchars($order['phone']); ?>
                </td>
                <td><?php echo nl2br(htmlspecialchars($order['address'])); ?></td>
                <td><?php echo htmlspecialchars($order['created_at']); ?></td>
                <td><a class="btn danger" href="/admin/order_delete.php?id=<?php echo (int)$order['id']; ?>" onclick="return confirm('Rendelés törlése?');">Törlés</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
