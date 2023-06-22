<?php

namespace dao;

use Category;
use DatabaseUtil;
use Product;
use product\Type;

require_once __DIR__ . '/../model/Product.php';
require_once __DIR__ . '/../model/product/Type.php';
require_once __DIR__ . '/../model/Category.php';

class ProductDAO {

    private DatabaseUtil $dbUtil;

    public function __construct(DatabaseUtil $dbUtil) {
        $this->dbUtil = $dbUtil;
    }

    // CRUD METHODS:

    // Create a new product
    public function createProduct(string $name, string $type, string $category, float $price, string $description): void {
        $conn = $this->dbUtil->getConnection();

        $stmt = $conn->prepare("INSERT INTO products (name, type, category, price, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssd", $name, $type, $category, $price, $description);

        if ($stmt->execute()) {
            echo "Product created successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    // Read all products
    public function getAllProducts(): array {
        $conn = $this->dbUtil->getConnection();

        $result = $conn->query("SELECT * FROM products");

        $products = []; // Array to store the product objects

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Create a new Product object with the retrieved data
                $product = new Product(
                    $row["name"],
                    new Type($row["type"]),
                    new Category($row["category"]),
                    (float) $row["price"],
                    $row["description"]
                );

                // Add the product object to the array
                $products[] = $product;
            }
        }

        return $products;
    }

    // Update a product by ID
    public function updateProduct(int $id, string $name, string $type, string $category, float $price, string $description): void {
        $conn = $this->dbUtil->getConnection();

        $stmt = $conn->prepare("UPDATE products SET name = ?, type = ?, category = ?, price = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssssdi", $name, $type, $category, $price, $description, $id);

        if ($stmt->execute()) {
            echo "Product updated successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    // Delete a product by ID
    public function deleteProduct(int $id): void {
        $conn = $this->dbUtil->getConnection();

        $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Product deleted successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
