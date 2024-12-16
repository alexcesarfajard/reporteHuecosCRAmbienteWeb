<?php
include_once 'Database.php';

class StreetReport {
    private $conn;
    private $table_name = "calles";

    public $id;
    public $nombre_calle;
    public $ubicacion;
    public $descripcion;
    public $tamano_estimado;
    public $estado;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Crear un reporte de calle
    public function report() {
        // Consulta para insertar el reporte
        $query = "INSERT INTO " . $this->table_name . " (nombre_calle, ubicacion, descripcion, tamano_estimado, estado) 
                  VALUES (:nombre_calle, :ubicacion, :descripcion, :tamano_estimado, :estado)";

        $stmt = $this->conn->prepare($query);

        // Limpiar los datos
        $this->nombre_calle = htmlspecialchars(strip_tags($this->nombre_calle));
        $this->ubicacion = htmlspecialchars(strip_tags($this->ubicacion));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->tamano_estimado = htmlspecialchars(strip_tags($this->tamano_estimado));
        $this->estado = htmlspecialchars(strip_tags($this->estado));

        // Bind datos
        $stmt->bindParam(":nombre_calle", $this->nombre_calle);
        $stmt->bindParam(":ubicacion", $this->ubicacion);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":tamano_estimado", $this->tamano_estimado);
        $stmt->bindParam(":estado", $this->estado);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;  // Si se ejecuta correctamente, el reporte se guardó
        }

        return false;  // Si ocurre un error, no se guardó
    }

    // Obtener todos los reportes de calles
    public function getAllReports() {
        // Consulta para seleccionar todos los reportes
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();  // Ejecuta la consulta

        return $stmt;  // Retorna los reportes encontrados
    }
}
?>
