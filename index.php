<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crud PHP</title>
</head>

<body>
  <div class="container my-5"></div>
  <h2>Lista de Clientes</h2>
  <a class="btn btn-primary" href="./create.php" role="button">Novo Cliente</a>
  <br>
  <table class="table">

    <thead>

      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Data de nascimento</th>
        <th>CPF</th>
        <th>Ação</th>

      </tr>
    </thead>

    <tbody>

      <?php

      $servername = "localhost";
      $username = "root";
      $password = "";
      $database = "myshop";
      //criar conexão
      $connection = new mysqli($servername, $username, $password, $database);
      //verificação de conexao
      if ($connection->connect_error) {
        die("Conexão com o banco falhou :[ " . $connection->connect_error);
      }
      //ler todas as linhas 
      $sql = "SELECT * FROM clients";
      $result = $connection->query($sql);

      if (!$result) {
        die("Inválido" . $connection->error);
      }

      //ler dados de cada linha
      while ($row = $result->fetch_assoc()) {
        echo " <tr>
        <td>$row[id] </td>
        <td>$row[nome]</td>
        <td>$row[email]</td>
        <td class='telefone'>$row[telefone]</td>
        <td>$row[data_nasc]</td>
        <td>$row[CPF]</td>
        <td>
          <a href='/CRUD/edit.php?id=$row[id]' class='btn btn-primary btn-sm'>Edit</a>
          <a href='/CRUD/delete.php?id=$row[id]' class='btn btn-danger btn-sm'>Delete</a>
        </td>
      </tr>
      ";
      }
      ?>

      <style>
        .telefone {
          visibility: collapse;
        }
      </style>
      <tr>
        <td>10</td>
        <td>Bill Gates</td>
        <td>bill.gates@microsoft.com</td>
        <td>+112223333</td>
        <td>10/10/1975</td>
        <td>10755517930</td>
        <td>
          <a href="./edit.php" class="btn btn-primary btn-sm">Edit</a>
          <a href="./delete.php" class="btn btn-danger btn-sm">Delete</a>
        </td>
      </tr>
    </tbody>

  </table>

</body>

</html>