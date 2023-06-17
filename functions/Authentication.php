<?php
// Inclusão do banco de dados
include('../data_base/banco_de_dados.php');

// Verifica se o email e a senha foram digitados
if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o email e a senha estão vazios
    if (empty($email)) {
        echo "Preencha seu e-mail";
    } else if (empty($senha)) {
        echo "Preencha sua senha";
    } else {
        // Bloqueia MySQL injection e busca o usuário no banco de dados
        $email = $conn->real_escape_string($email);
        $senha = $conn->real_escape_string($senha);
        $sql_code = "SELECT * FROM users WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $conn->query($sql_code) or die("Falha na execução do código SQL: " . $conn->error);

        // Recebe a quantidade de usuários que possuem o email e senha digitados
        $quantidade = $sql_query->num_rows;

        // Se o usuário foi encontrado, armazena os dados na sessão
        if ($quantidade == 1) {
            $usuario = $sql_query->fetch_assoc();

            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['user'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: ../pages/home.html");
            exit();
        } else {
            echo "Falha no login, e-mail ou senha incorretos";
        }
    }
}
?>
