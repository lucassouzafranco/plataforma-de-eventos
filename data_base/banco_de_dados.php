<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Dados_eventos";
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

    //conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    //verificação
    if($conn->connect_error){
        die("Falha na conexão do servidor");
    }

    if($conn->query($sql)===false){
        echo("Erro na criação do banco de dados".$conn->error);
        $conn->close();
    }
    $conn->select_db($dbname);

    $sql = "CREATE TABLE USERS(
        ID integer(6) unsigned  auto_increment,
        nome varchar(40) not null,
        email varchar(40) not null,
        senha varchar(25) not null,
        Tipo_usuario varchar(20) not null,
        primary key(ID)
    )";
    if($conn->query($sql)===FALSE){
        echo("Não foi possivel criar a tabela USERS".$conn->error);
    }

    $sql = "CREATE TABLE EVENTS(
        titulo varchar(45) not null,
        descrição varchar(200) not null,
        data_evento date not null,
        hora time not null,
        local_evento varchar(45),
        categoria varchar(20) not null,
        preco varchar(5),
        imagem LONGBLOB,
        primary key(titulo)
    )";
    if($conn->query($sql)===FALSE){
        echo("Não foi possivel criar a tabela EVENTS".$conn->error);
    }

    $sql = "CREATE TABLE REGISTRATIONS(
        ID_usuario integer(6),
        evento varchar(45),
        status_pagamento varchar(10) ,
        FOREIGN KEY(ID_usuario) references USERS(ID),
        FOREIGN KEY(evento) references EVENTS(titulo) 

    )";
    if($conn->query($sql)===FALSE){
        echo("Não foi possivel criar a tabela REGISTRATIONS".$conn->error);
    }

    $sql = "CREATE TABLE REVIEWS(
        comentarios varchar(100),
        usuario integer(6),
        evento varchar(45),
        pontuacao integer(2),
        FOREIGN KEY (usuario) references USERS(ID),
        FOREIGN KEY (evento) references EVENTS(titulo)
    )";
    if($conn->query($sql)===FALSE){
        echo("Não foi possivel criar a tabela REVIEWS".$conn->error);
    }

    $sql = "CREATE TABLE CATEGORIES(
        categoria_evento varchar(45)
    )";
    if($conn->query($sql)===FALSE){
        echo("Não foi possivel criar a tabela CATEGORIES".$conn->error);
    }
?>