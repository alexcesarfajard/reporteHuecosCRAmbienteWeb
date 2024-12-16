<?php
class StreetRepair {
    private $conn;
    private $table_name = "calles_reparacion"; // Asegúrate de que el nombre de tu tabla es correcto

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para añadir una nueva calle a la base de datos
    public function addStreet($nombre_calle, $ubicacion, $descripcion, $fecha_inicio, $estado) {
        // SQL para insertar la nueva calle
        $query = "INSERT INTO " . $this->table_name . " (nombre_calle, ubicacion, descripcion, fecha_inicio, estado) 
                  VALUES (:nombre_calle, :ubicacion, :descripcion, :fecha_inicio, :estado)";
        
        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Enlazar los parámetros
        $stmt->bindParam(':nombre_calle', $nombre_calle);
        $stmt->bindParam(':ubicacion', $ubicacion);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio);
        $stmt->bindParam(':estado', $estado);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true; // La calle fue añadida con éxito
        }
        return false; // Ocurrió un error al añadir la calle
    }
}
?>
