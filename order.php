<?php
$pageTitle = 'Rendelés | IT Shop';
require_once __DIR__ . '/includes/functions.php';
$products = get_products();
$message = null;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'product_id' => (int)($_POST['product_id'] ?? 0),
        'quantity' => (int)($_POST['quantity'] ?? 1),
        'customer_name' => trim($_POST['customer_name'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'phone' => trim($_POST['phone'] ?? ''),
        'address' => trim($_POST['address'] ?? ''),
        'notes' => trim($_POST['notes'] ?? ''),
    ];

    if ($data['product_id'] <= 0) {
        $errors[] = 'Válasszon terméket.';
    }
    if ($data['quantity'] <= 0) {
        $errors[] = 'A mennyiség legyen legalább 1.';
    }
    if ($data['customer_name'] === '') {
        $errors[] = 'Adja meg a nevét.';
    }
    if ($data['email'] === '') {
        $errors[] = 'Adja meg az email címét.';
    }
    if ($data['address'] === '') {
        $errors[] = 'Adja meg a szállítási címet.';
    }

    if (empty($errors)) {
        if (create_order($data)) {
            $message = 'Rendelés sikeresen rögzítve!';
        } else {
            $errors[] = 'Hiba történt a rendelés mentésekor.';
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>
<section>
    <h1>Gyors rendelés</h1>
    <?php if ($message): ?>
        <div class="alert success"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
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
        <label>Termék
            <select name="product_id" required>
                <option value="">Válasszon...</option>
                <?php foreach ($products as $product): ?>
                    <option value="<?php echo (int)$product['id']; ?>" <?php echo (isset($data['product_id']) && (int)$data['product_id'] === (int)$product['id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($product['name']); ?> (<?php echo number_format((float)$product['price'], 0, ',', ' '); ?> Ft)
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Mennyiség
            <input type="number" name="quantity" value="<?php echo isset($data['quantity']) ? (int)$data['quantity'] : 1; ?>" min="1" required />
        </label>
        <label>Teljes név
            <input type="text" name="customer_name" value="<?php echo htmlspecialchars($data['customer_name'] ?? ''); ?>" required />
        </label>
        <label>Email
            <input type="email" name="email" value="<?php echo htmlspecialchars($data['email'] ?? ''); ?>" required />
        </label>
        <label>Telefon
            <input type="text" name="phone" value="<?php echo htmlspecialchars($data['phone'] ?? ''); ?>" />
        </label>
        <label>Szállítási cím
            <textarea name="address" required><?php echo htmlspecialchars($data['address'] ?? ''); ?></textarea>
        </label>
        <label>Megjegyzés
            <textarea name="notes" placeholder="Opcionális"></textarea>
        </label>
        <button type="submit">Rendelés leadása</button>
    </form>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
