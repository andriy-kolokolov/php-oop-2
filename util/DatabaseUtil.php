<?php
class DatabaseUtil {
    private string $servername;
    private string $username;
    private string $password;
    private string $dbname;
    private mysqli $conn;

    public function __construct(string $servername, string $username, string $password, string $dbname) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    public function connect(): void {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function close(): void {
        $this->conn->close();
    }

    public function getConnection(): mysqli {
        return $this->conn;
    }
}