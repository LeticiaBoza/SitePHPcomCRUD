<?php

    //PDO: php data objetct - ele é uma classe e suporta outros tipos de banco de dados. myqli só suporta o mysql - https://www.devmedia.com.br/introducao-ao-php-pdo/24973

    $hostname = "localhost";
    $database = "agenda";
    $user = "root";
    $password = "usbw";

    //try: tente fazer isso, se não.. cai no catch 
    //ele vai tentar fazer a conexão. se tiver erro, vai pro catch 

    try{ //estamos instanciando o objeto conn e fazendo um construtor - o objeto já vai nascer com essas características
        $conn = new PDO("mysql:host=$hostname;dbname=$database",$user,$password);
        $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Conexão efetuada com sucesso!";
    }
//setAttribute é setar atributo, por que as vezes o objeto ele tenta fazer a conexão com a base de dados e acontece algum erro - por isso temos que setar o atributo que virá aí como excessão. existem vários tipos de atributos. (pesquisar no manual do php PDOattr) - se a conexão não fluir ele vai cair no catch.  
    catch(PDOException $e){
        echo "Falha na conexão: " . $e->getMessage();
    } //quando cai no cacht, temos que passar o tipo da excessão. essa variável vai conter o valor do tipo exception. o getMessage vai trazer o motivo do erro. 
    //quando trabalhamos com classe usamos o -> 
    //PDO é uma classe
?>