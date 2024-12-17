<?php 

include("Database.php");
session_start();

$sql = "SELECT * FROM user WHERE username = '".$_POST["username"]."'";
$result = $conn->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        if($_POST["username"] ==  $row["username"] && password_verify( $_POST["password"], $row["password"])){
            $_SESSION["username"] = $row["username"];
            $_SESSION["rol"] = $row["rol"];
            header("Location: index.php");
        } else {
            echo "Clave incorrecta!";
        }
    }
} else {
    echo "El usuario no existe";
}
