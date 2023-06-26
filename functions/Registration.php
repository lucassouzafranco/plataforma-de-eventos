<?php
    include('../php_class/user_class.php');
    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verifica se todos os campos foram preenchidos
        if (isset($_POST['nome'], $_POST['email'], $_POST['Senha'], $_POST['tipo_usuario'])) {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['Senha'];
            $tipo_usuario = $_POST['tipo_usuario'];
            
            // Realizar as validações necessárias
            if (empty($nome)) {
                echo "Por favor, preencha o campo Nome";
            } elseif (empty($email)) {
                echo "Por favor, preencha o campo Email";
            } elseif (empty($senha)) {
                echo "Por favor, preencha o campo Senha";
            } elseif (empty($tipo_usuario)) {
                echo "Por favor, marque o tipo de usuário";
            } else {
                // Conectar ao banco de dados
                $conn = new mysqli("localhost", "root", "", "eventos");
    
                // Verificar se houve erros na conexão
                if ($conn->connect_error) {
                    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
                }
    
                // Verificar se o email já está cadastrado
                $sql_check_email = "SELECT * FROM users WHERE email = '$email'";
                $result_check_email = $conn->query($sql_check_email);
    
                if ($result_check_email->num_rows > 0) {
                    echo "O email já está cadastrado. Por favor, utilize outro email.";
                } else {
                    // Criação do objeto User
                    $user = new User($nome, $email, $senha, $tipo_usuario);
    
                    // Inserir os dados no banco de dados
                    $sql_insert_user = "INSERT INTO users (nome, email, senha, tipo_usuario) VALUES ('$nome', '$email', '$senha', '$tipo_usuario')";
    
                    if ($conn->query($sql_insert_user) === TRUE) {
                        // Redirecionar para a página de sucesso, por exemplo
                        header("Location: ../pages/home.html");
                        exit();
                    } else {
                        // Exibir o erro no registro
                        echo "Erro ao realizar o registro: " . $conn->error;
                    }
                }
    
                // Fechar a conexão com o banco de dados
                $conn->close();
            }
        } else {
            echo "Por favor, preencha todos os campos do formulário.";
        }
    }

?>
