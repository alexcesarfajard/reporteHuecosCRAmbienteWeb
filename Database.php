<?php
class Database {
    private $host = "localhost";
    private $db_name = "reporte_calles";
    private $username = "root";
    private $password = "root";
    public $conn;

    // Conectar a la base de datos
    public function getConnection() {
        $this->conn = null;
        
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Conexión fallida: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
