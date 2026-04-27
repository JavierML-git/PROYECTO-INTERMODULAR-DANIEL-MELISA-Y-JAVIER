<?php
// db.php
$conexion = "mysql:host=localhost:3308;dbname=restaurante;charset=utf8mb4";
$user = "root";   
$pass = "";



try {
  $newobj = new PDO($conexion, $user, $pass);
} catch (PDOException $except) {
  die("Error de conexión: " . $except->getMessage());
}
?>
