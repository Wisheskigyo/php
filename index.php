<?php
$pageTitle = 'Rólunk | IT Shop';
require_once __DIR__ . '/includes/header.php';
?>
<section class="hero">
    <div class="hero-text">
        <h1>Számítógépek és tartozékok egy helyen</h1>
        <p>Minimalista, letisztult felület, megbízható árukészlet, gyors szállítás.</p>
        <div class="actions">
            <a class="btn" href="/products.php">Termékek böngészése</a>
            <a class="btn ghost" href="/order.php">Gyors rendelés</a>
        </div>
    </div>
</section>
<section class="grid two-cols">
    <div>
        <h2>Rólunk</h2>
        <p>Az IT Shop csapata lelkes hardver-rajongókból áll, akiknek a célja, hogy minőségi gépeket és kiegészítőket kínáljanak átlátható formában.</p>
    </div>
    <div>
        <h2>Szolgáltatásaink</h2>
        <ul class="list">
            <li>Egyedi PC konfigurációk tanácsadással</li>
            <li>Alkatrészek és perifériák gyors kiszállítással</li>
            <li>Garanciális ügyintézés és support</li>
        </ul>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
