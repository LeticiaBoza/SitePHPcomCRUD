<?php
require_once("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nomeErro = null;
    $telefoneErro = null;
    $emailErro = null;
    $validacao = true;

    if (isset($_POST["nome"]) && !empty($_POST["nome"])){
        
        $nome = $_POST["nome"];
    }else{
        $nomeErro = "Por favor, digite seu nome completo.";
        $validacao = false;
    }


    if (isset($_POST["telefone"]) && !empty($_POST["telefone"])){
        
        $telefone = $_POST["telefone"];
    }else{
        $telefoneErro = "Por favor, digite seu telefone corretamente.";
        $validacao = false;
    }


    if (isset($_POST["email"]) && !empty($_POST["email"])){
        
        $email = $_POST["email"];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailErro = "Por favor, digite um e-mail válido.";
            $validacao = false;
        }
    }else{
        $emailErro = "Por favor, digite seu e-mail.";
        $validacao = false;
    }

    if($validacao == true){
        try{
            $sql = $conn->prepare("INSERT INTO contato(nm_contato, nm_telefone, nm_email) VALUES(?,?,?)");
            $sql->execute(array($nome, $telefone, $email));
            
            $conn = null;
            //header("Location: index.php");
            echo "<script language=\"javascript\">
                alert(\"Contato cadastrado com sucesso!\")
                </script>";
        }

        catch(PDOException $e){
            echo "Falha ao inserir contato: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de contatos</title>
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
</head>
<body>

    <div class="container">
        <div class="span10 offset1">
            <div class="card-header">
                <h3 class="well">Adicionar Contato</h3>
            </div>

            <div class="card-body">
                <form action="create.php" class="form-horizontal" method="POST"> 

                    <div class="control-group">
                        <label class="control-label">Nome: </label>
                        <div class="controls">
                            <input size="50" class="form-control" name="nome" type="text" placeholder="Nome completo">
                            <span class="text-danger"><?php echo $nomeErro; ?></span>
                        </div>
                    </div>

                    <br>

                    <div class="control-group">
                        <label class="control-label">Telefone: </label>
                        <div class="controls">
                            <input size="35" class="form-control" name="telefone" type="text" placeholder="(xx) xxxx-xxx">
                            <span class="text-danger"><?php echo $telefoneErro; ?></span>
                        </div>
                    </div>

                    <br>

                    <div class="control-group">
                        <label class="control-label">E-mail: </label>
                        <div class="controls">
                            <input size="40" class="form-control" name="email" type="text" placeholder="dominio@email.com">
                            <span class="text-danger"><?php echo $emailErro; ?></span>
                        </div>
                    </div>

                    <br>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                        <a href="index.php" class="btn btn-success">Voltar</a>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>