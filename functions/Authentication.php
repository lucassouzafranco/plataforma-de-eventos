<?php
session_start();

include('../data_base/banco_de_dados.php');

if(isset($_POST['email']) && isset($_POST['senha'])){
    if(empty($_POST['email'])){
        echo "Preencha seu e-mail";
    }else if(empty($_POST['senha'])){
        echo "Preencha sua senha";
    }else{
        $email = $conn->real_escape_string($_POST['email']);
        $senha = $conn->real_escape_string($_POST['senha']);
        $sql_code = "SELECT * FROM users WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $conn->query($sql_code) or die("Falha na execução do código SQL: " . $conn->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1){
            $usuario = $sql_query->fetch_assoc();
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: home.html");
            exit();
        }else{
            echo "Falha no login, e-mail ou senha incorretos";
        }
    } 
}
?>