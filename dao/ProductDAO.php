<?php
namespace dao;

use Category;
use DatabaseUtil;
use Exception;
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

        try {
            if ($stmt->execute()) {
                // Product created successfully
            } else {
                throw new Exception("Error creating product: " . $stmt->error);
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
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

        try {
            if ($stmt->execute()) {
                // Product updated successfully
            } else {
                throw new Exception("Error updating product: " . $stmt->error);
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

        $stmt->close();
    }

    // Delete a product by ID
    public function deleteProduct(int $id): void {
        $conn = $this->dbUtil->getConnection();

        $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);

        try {
            if ($stmt->execute()) {
                // Product deleted successfully
            } else {
                throw new Exception("Error deleting product: " . $stmt->error);
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

        $stmt->close();
    }

    // Create the 'products' table
    public function createProductsTable(): void {
        $conn = $this->dbUtil->getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS products (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        type VARCHAR(50) NOT NULL,
        category VARCHAR(50) NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        description TEXT
    )";

        try {
            if ($conn->query($sql) === true) {
                // Table 'products' created successfully
            } else {
                throw new Exception("Error creating table: " . $conn->error);
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Drop table
    public function dropProductsTable(): void {
        $conn = $this->dbUtil->getConnection();

        $sql = "DROP TABLE IF EXISTS products";

        try {
            if ($conn->query($sql) === true) {
                // Table 'products' dropped successfully
            } else {
                throw new Exception("Error dropping table: " . $conn->error);
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}
