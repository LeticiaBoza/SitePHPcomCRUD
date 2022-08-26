<?php
    require_once("connection.php");

    if(!empty($_GET['id'])){
        $id = $_GET['id'];
    }

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
    }

    if($validacao == true){
        try{
            $sql = $conn->prepare("UPDATE contato SET nm_contato = ?, nm_telefone = ?, nm_email = ? WHERE cd_contato = ?");
            $sql->execute(array($nome, $telefone, $email, $id));
            
            $conn = null;
            //header("Location: index.php");
            echo "<script language=\"javascript\">
                alert(\"Contato atualizado com sucesso!\")
                location.replace(\"index.php\");
                </script>";
        }

        catch(PDOException $e){
            echo "Falha ao atualizar contato: " . $e->getMessage();
        }
    }

    else{
        require_once("connection.php");
            try{
                $sql = $conn->prepare("SELECT * FROM contato WHERE cd_contato = ?");//usamos o prepare por que já temos a informação. ele não funfa se você tiver que passar um parâmetro pra ele, mas como ele já tem podemos utilizar. 

                $sql->execute(array($id));
                $data = $sql->fetch(PDO::FETCH_ASSOC); //o data vai ser nosso array. o fetch vai associar a coluna àquele campo específico, criando um array anexado. o que referência que o telefone está em determinado campo? neste caso é o fetch
                $nome = $data['nm_contato'];
                $telefone = $data['nm_telefone'];
                $email = $data['nm_email'];
            }
        catch(PDOException $e){
            echo "Falha ao buscar contato: " . $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atualizar Contato</title>
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="card-header">
                <h3 class="well">Atualizar Contato</h3>
            </div>

            <div class="card-body">
                <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="POST">
                    <div class="control-group">
                        <label class="control-label">Nome:</label>
                        <div class="controls">
                            <input name="nome" class="form-control" size="50" type="text" placeholder="Nome" value="<?php echo !empty($nome) ? $nome : ''; ?>">  
                            <span class="text-danger"><?php echo $nomeErro; ?></span>
                        </div>
                    </div>

                    <br>

                    <div class="control-group">
                        <label class="control-label">Telefone:</label>
                        <div class="controls">
                            <input name="telefone" class="form-control" size="50" type="text" placeholder="Telefone" value="<?php echo !empty($telefone) ? $telefone : ''; ?>">  
                            <span class="text-danger"><?php echo $telefoneErro; ?></span>
                        </div>
                    </div>

                    <br>

                    <div class="control-group">
                        <label class="control-label">E-mail:</label>
                        <div class="controls">
                            <input name="email" class="form-control" size="50" type="text" placeholder="E-mail" value="<?php echo !empty($email) ? $email : ''; ?>">  
                            <span class="text-danger"><?php echo $emailErro; ?></span>
                        </div>
                    </div>

                    <br>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning">Atualizar</button>
                        <a href="index.php" class="btn btn-sucess">Voltar</a>
                </form>
            </div>
        </div>
    </div>

</body>
</html>