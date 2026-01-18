<?php
$pageTitle = 'Termékek | IT Shop';
require_once __DIR__ . '/includes/functions.php';
$search = isset($_GET['q']) ? trim($_GET['q']) : null;
$products = get_products($search ?: null);
require_once __DIR__ . '/includes/header.php';
?>
<section>
    <h1>Termékek</h1>
    <form class="search-form" method="get">
        <input type="text" name="q" placeholder="Keresés név vagy kategória szerint" value="<?php echo htmlspecialchars($search ?? ''); ?>" />
        <button type="submit">Keresés</button>
    </form>
    <?php if ($search): ?>
        <p class="muted">Keresési kifejezés: <strong><?php echo htmlspecialchars($search); ?></strong></p>
    <?php endif; ?>
    <div class="card-grid">
        <?php if (empty($products)): ?>
            <p>Nincs megjeleníthető termék.</p>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <article class="card">
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p class="muted"><?php echo htmlspecialchars($product['category']); ?></p>
                    <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                    <div class="card-footer">
                        <span class="price"><?php echo number_format((float)$product['price'], 0, ',', ' '); ?> Ft</span>
                        <span class="stock"><?php echo (int)$product['stock']; ?> db raktáron</span>
                    </div>
                    <a class="btn small" href="/order.php?product_id=<?php echo (int)$product['id']; ?>">Megrendelem</a>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
