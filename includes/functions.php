<?php
require_once __DIR__ . '/db.php';

function get_products(string $searchTerm = null): array
{
    global $conn;
    $products = [];
    if ($searchTerm) {
        $stmt = $conn->prepare('SELECT id, name, category, price, stock, description, created_at FROM products WHERE name LIKE CONCAT("%", ?, "%") OR category LIKE CONCAT("%", ?, "%") ORDER BY created_at DESC');
        $stmt->bind_param('ss', $searchTerm, $searchTerm);
    } else {
        $stmt = $conn->prepare('SELECT id, name, category, price, stock, description, created_at FROM products ORDER BY created_at DESC');
    }
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    $stmt->close();
    return $products;
}

function get_product(int $id): ?array
{
    global $conn;
    $stmt = $conn->prepare('SELECT id, name, category, price, stock, description FROM products WHERE id = ?');
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        $stmt->close();
        return $product ?: null;
    }
    $stmt->close();
    return null;
}

function create_product(array $data): bool
{
    global $conn;
    $stmt = $conn->prepare('INSERT INTO products (name, category, price, stock, description) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('ssdis', $data['name'], $data['category'], $data['price'], $data['stock'], $data['description']);
    $ok = $stmt->execute();
    $stmt->close();
    return $ok;
}

function update_product(int $id, array $data): bool
{
    global $conn;
    $stmt = $conn->prepare('UPDATE products SET name = ?, category = ?, price = ?, stock = ?, description = ? WHERE id = ?');
    $stmt->bind_param('ssdisi', $data['name'], $data['category'], $data['price'], $data['stock'], $data['description'], $id);
    $ok = $stmt->execute();
    $stmt->close();
    return $ok;
}

function delete_product(int $id): bool
{
    global $conn;
    $stmt = $conn->prepare('DELETE FROM products WHERE id = ?');
    $stmt->bind_param('i', $id);
    $ok = $stmt->execute();
    $stmt->close();
    return $ok;
}

function create_order(array $data): bool
{
    global $conn;
    $stmt = $conn->prepare('INSERT INTO orders (product_id, quantity, customer_name, email, phone, address, notes, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())');
    $stmt->bind_param('iisssss', $data['product_id'], $data['quantity'], $data['customer_name'], $data['email'], $data['phone'], $data['address'], $data['notes']);
    $ok = $stmt->execute();
    $stmt->close();
    return $ok;
}

function get_orders(): array
{
    global $conn;
    $orders = [];
    $query = 'SELECT o.id, o.quantity, o.customer_name, o.email, o.phone, o.address, o.notes, o.created_at, p.name AS product_name FROM orders o LEFT JOIN products p ON p.id = o.product_id ORDER BY o.created_at DESC';
    if ($result = $conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
    }
    return $orders;
}

function delete_order(int $id): bool
{
    global $conn;
    $stmt = $conn->prepare('DELETE FROM orders WHERE id = ?');
    $stmt->bind_param('i', $id);
    $ok = $stmt->execute();
    $stmt->close();
    return $ok;
}
?>
