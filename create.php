<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "myshop";
//criar conexão
$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$nome = "";
$email = "";
//filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$telefone = "";
$data_nasc = "";
$CPF = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nome = $_POST["nome"];
  $email = $_POST["email"];

  $telefone = ($_POST["telefone"]);
  $data_nasc = $_POST["data_nasc"];
  $CPF = $_POST["CPF"];
}

//verificação de campos
do {
  if (empty($nome) || empty($email) || empty($telefone) || empty($data_nasc) || empty($CPF)) {
    $errorMessage = "Todos os campos devem ser preenchidos";
    break;
  }

  //checando telefone 


  $CPF = $_POST['CPF']; //aqui você resgata o login digitado
  $sql = "SELECT * FROM clients WHERE CPF='$CPF' ";
  $result = $connection->query($sql); //executa o query
  $busca = mysqli_num_rows($result); //pega o total das linhas encontradas


  if (($busca) == '0') {
    $sql = "INSERT INTO clients (nome, email, telefone, data_nasc, CPF)" . "VALUES('$nome', '$email', '$telefone', '$data_nasc', '$CPF')";   //pois se foi 0, não encontrou nenhum registro igual
  } else {
    $errorMessage = "Desculpe, CPF já foi cadastrado: " . $connection->error;
    break;
  }



  //adiciona novo cliente no db
  $sql = "INSERT INTO clients (nome, email, telefone, data_nasc, CPF)" . "VALUES('$nome', '$email', '$telefone', '$data_nasc', '$CPF')";
  $result = $connection->query($sql);











  //checando
  if (!$result) {

    $errorMessage = "Campo inválido: " . $connection->error;
    break;
  }
  $nome = "";
  $email = "";
  $telefone = "";
  $data_nasc = "";
  $CPF = "";

  $successMessage = "Cliente adicionado com sucesso!";



  header("location: /CRUD/index.php");
  exit;
} while (false);


?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>CRUD2</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <div class="container my-5">
    <h2>Novo Cliente</h2>

    <?php
    if (!empty($errorMessage)) {
      echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>$errorMessage <strong>
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>
  ";
    }
    ?>


    <form method="POST">
      <div class="row mb-3">
        <label class="col-sm-3 col-form label">Nome</label>
        <div class="col-sm-6">
          <input type="text" class="form-control " name="nome" value="<?php echo $nome; ?>">
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-3 col-form label">Email</label>
        <div class="col-sm-6">
          <input type="email" class="form-control " name="email" value="<?php echo $email; ?>">
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-3 col-form label">Telefone</label>
        <div class="col-sm-6">
          <input type="number" class="form-control " name="telefone" value="<?php echo $telefone; ?>">
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-3 col-form label">Data de Nascimento</label>
        <div class="col-sm-6">
          <input type="date" class="form-control " name="data_nasc" value="<?php echo $data_nasc; ?>">
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-3 col-form label">CPF</label>
        <div class="col-sm-6">
          <input type="number" class="form-control " name="CPF" value="<?php print(implode("", array_reverse(explode("-", $CPF)))); ?>">
        </div>
      </div>

      <?php

      if (!empty($successMessage)) {
        echo "<div class='row mb-3'>
  <div class='offset-sm-3 col-sm-6'>
  <div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>$successMessage </strong>
<button type='button' class='btn-close' data-bs-dismiss='alert' aria'label></button>
</div>
</div>
</div>
  ";
      }
      ?>

      <div class="row mb-3">
        <div class="offset-sm-3 col-sm-3 d-grid">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <div class="col-sm-3 d-grid">
          <a class="btn btn-outline-primary" href="/CRUD/index.php" role="button">Cancel</a>
        </div>
      </div>
  </div>

  </form>

  </div>
</body>

</html>