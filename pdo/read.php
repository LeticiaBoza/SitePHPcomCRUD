<?php
    require_once("connection.php");

    if (!empty ($_GET['id'])){
        $id = $_GET['id'];
    }

    try{
        $sql = $conn->prepare("SELECT * FROM contato WHERE cd_contato = ?");
        $sql->execute(array($id));
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        $nome = $data['nm_contato'];
        $telefone = $data['nm_telefone'];
        $email = $data['nm_email'];
    }
    catch(PDOException $e){
        echo "Falha ao excluir contato: " . $e->getMEssage();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informações de contato</title>
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="card">
                <div class="card-header">
                    <h3 class="well">Informações Contato</h3>
                </div>

                <div class="container">
                    <div class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">Nome:</label>
                            <div class="controls form-control">
                                <label class="carousel-inner">
                                    <?php echo $nome; ?>
                                </label>
                            </div> 
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">Telefone:</label>
                            <div class="controls form-control disabled">
                                <label class="carousel-inner">
                                <?php echo $telefone; ?>
                                </label>
                            </div> 
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">E-mail:</label>
                            <div class="controls form-control disabled">
                                <label class="carousel-inner">
                                <?php echo $email; ?>
                                </label>
                            </div> 
                        </div>

                        <br>

                        <div class="form-actions">
                            <a href="index.php" type="btn" class="btn btn-success">Voltar</a>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</body>
</html>