<?php
//checando pra ver se consegue ler o id
if (isset($_GET["id"])) {
  $id = $_GET["id"];


  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "myshop";
  //criar conexão
  $connection = new mysqli($servername, $username, $password, $database);


  $sql = "DELETE FROM clients WHERE id=$id";
  $connection->query($sql);
}


header("location: /CRUD/index.php");
exit;
