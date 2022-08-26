<?php
    require_once("connection.php");

    if (!empty ($_GET['id'])){
        $id = $_GET['id'];
    }

    if(isset($_POST['id']) && !empty($_POST['id'])){
        $cd = $_POST['id'];

        try{
            $sql = $conn->prepare("DELETE FROM contato WHERE cd_contato = ?");
            $sql->execute(array($cd));
            echo "<script language=\"javascript\">
                alert(\"Contato excluído com sucesso\");
                location.replace(\"index.php\");
                </script>";
            $conn = null;
        }

        catch(PDOException $e){
        echo "Falha ao excluir contato: " . $e->getMEssage();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Excluir contato</title>
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3 >Excluir contato</h3>
            </div>

            <form action="delete.php" class="form-horizontal" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="alert alert-danger">Tem certeza que deseja excluir?
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-danger">Sim</button>
                        <a href="index.php" type="btn" class="btn btn-outline-danger">Não</a>
                    </div>
            </form>
        </div>
    </div>
</body>
</html>