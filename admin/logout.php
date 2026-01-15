<?php
// Kijelentkezés Basic Auth esetén: új 401-es válasz új realmmel, hogy a böngésző eldobja a cache-elt hitelesítést.
header('HTTP/1.1 401 Unauthorized');
header('WWW-Authenticate: Basic realm="Kiléptetés"');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kijelentkezés | IT Shop Admin</title>
    <meta http-equiv="refresh" content="1;url=/index.php">
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body>
    <div class="container">
        <h1>Kijelentkeztél</h1>
        <p>Visszairányítás a főoldalra...</p>
        <p><a class="btn" href="/index.php">Ugrás most</a></p>
    </div>
</body>
</html>
