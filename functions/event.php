<?php
require_once '../php_class/event_class.php';
require_once '../data_base/banco_de_dados.php';

// Verifica se o formulário foi enviado via método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se todas as variáveis foram enviadas
    $requiredFields = ['titulo', 'descricao', 'data_evento', 'hora', 'local', 'categoria', 'preco', 'imagem'];
    $missingFields = array_filter($requiredFields, function ($field) {
        return empty($_POST[$field]);
    });

    if (!empty($missingFields)) {
        echo "Por favor, preencha todos os campos do formulário.";
        exit();
    }

    // Obter os valores do formulário
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data_evento = $_POST['data_evento'];
    $hora = $_POST['hora'];
    $local = $_POST['local'];
    $categoria = $_POST['categoria'];
    $preco = $_POST['preco'];
    $imagem = $_POST['imagem'];

    // Realizar as validações necessárias
    if (empty($titulo)) {
        echo "Por favor, preencha o campo Título";
        exit();
    } elseif (empty($descricao)) {
        echo "Por favor, preencha o campo Descrição";
        exit();
    } elseif (empty($hora)) {
        echo "Por favor, preencha o campo Hora";
        exit();
    } elseif (empty($local)) {
        echo "Por favor, preencha o campo Local";
        exit();
    } elseif (empty($categoria)) {
        echo "Por favor, preencha o campo Categoria";
        exit();
    } elseif (empty($preco)) {
        echo "Por favor, preencha o campo Preço";
        exit();
    } elseif (empty($imagem)) {
        echo "Por favor, preencha o campo Imagem";
        exit();
    }

    // Conectar ao banco de dados
    $conn = new mysqli("localhost", "root", "", "eventos");

    // Verificar se houve erros na conexão
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Verificar se o título já está cadastrado
    $sql_check_event_titulo = "SELECT * FROM events WHERE titulo = '$titulo'";
    $result_event_titulo = $conn->query($sql_check_event_titulo);

    if ($result_event_titulo->num_rows > 0) {
        echo "Já existe um evento com esse título. Por favor, utilize outro título.";
        exit();
    }

    // Criação do objeto Event
    $evento = new Event($titulo, $descricao, $data_evento, $hora, $local, $categoria, $preco, $imagem);

    // Inserir os dados no banco de dados
    $sql_insert_event = "INSERT INTO events (titulo, descricao, data_evento, hora, local, categoria, preco, imagem) VALUES ('$titulo', '$descricao', '$data_evento', '$hora', '$local', '$categoria', '$preco', '$imagem')";

    if ($conn->query($sql_insert_event) === TRUE) {
        // Redirecionar para a página de sucesso, por exemplo
        header("Location: ../pages/home.html");
        
        exit();
    } else {
        // Exibir o erro no registro
        echo "Erro ao realizar o registro: " . $conn->error;
        exit();
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
}
?>
