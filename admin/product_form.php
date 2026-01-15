<?php
require_once __DIR__ . '/../includes/functions.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$product = $id ? get_product($id) : null;
$message = null;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => trim($_POST['name'] ?? ''),
        'category' => trim($_POST['category'] ?? ''),
        'price' => (float)($_POST['price'] ?? 0),
        'stock' => (int)($_POST['stock'] ?? 0),
        'description' => trim($_POST['description'] ?? ''),
    ];

    if ($data['name'] === '') {
        $errors[] = 'A név kötelező.';
    }
    if ($data['price'] <= 0) {
        $errors[] = 'Az ár legyen pozitív.';
    }

    if (empty($errors)) {
        $ok = $id ? update_product($id, $data) : create_product($data);
        if ($ok) {
            header('Location: /admin/index.php');
            exit;
        }
        $errors[] = 'Mentési hiba.';
    }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $id ? 'Termék szerkesztése' : 'Új termék'; ?></title>
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body>
<header>
    <div class="container">
        <nav>
            <a href="/admin/index.php">Vissza</a>
            <a href="/index.php">Főoldal</a>
            <a href="/admin/logout.php">Kijelentkezés</a>
        </nav>
    </div>
</header>
<div class="container">
    <h1><?php echo $id ? 'Termék szerkesztése' : 'Új termék'; ?></h1>
    <?php if (!empty($errors)): ?>
        <div class="alert error">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form class="form" method="post">
        <label>Név
            <input type="text" name="name" value="<?php echo htmlspecialchars($product['name'] ?? ''); ?>" required />
        </label>
        <label>Kategória
            <input type="text" name="category" value="<?php echo htmlspecialchars($product['category'] ?? ''); ?>" />
        </label>
        <label>Ár (Ft)
            <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($product['price'] ?? ''); ?>" required />
        </label>
        <label>Készlet
            <input type="number" name="stock" value="<?php echo htmlspecialchars($product['stock'] ?? 0); ?>" />
        </label>
        <label>Leírás
            <textarea name="description" rows="4"><?php echo htmlspecialchars($product['description'] ?? ''); ?></textarea>
        </label>
        <button class="btn" type="submit">Mentés</button>
    </form>
</div>
</body>
</html>
