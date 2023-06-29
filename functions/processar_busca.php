<?php

require_once '../data_base/banco_de_dados.php';

class EventoSearch {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function buscarEventos($pesquisa) {
        $pesquisa = $this->conn->real_escape_string($pesquisa);
        $sql_code = "SELECT * FROM events WHERE titulo LIKE '%$pesquisa%' OR descricao LIKE '%$pesquisa%'";

        $sql_query = $this->conn->query($sql_code) or die("ERRO NA BUSCA!" . $this->conn->error);

        if ($sql_query->num_rows == 0) {
            echo 'Nenhum resultado encontrado';
        } else {
            while ($dados = $sql_query->fetch_assoc()) {
                echo '<div class="evento">';
                echo '<h3>' . $dados['titulo'] . '</h3>';
                echo '<p>' . $dados['descricao'] . '</p>';
                echo '<p>Data do evento: ' . $dados['data_evento'] . '</p>';
                echo '<p>Hora: ' . $dados['hora'] . '</p>';
                echo '<p>Local: ' . $dados['local'] . '</p>';
                echo '<p>Categoria: ' . $dados['categoria'] . '</p>';
                echo '<p>Preço: ' . $dados['preco'] . '</p>';
                echo '</div>';
            }
        }
    }
}

if (empty($_GET['busca'])) {
    echo "Digite algo para fazer a busca...";
} else {
    $conn = new mysqli("localhost", "root", "", "eventos");

    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    $eventoSearch = new EventoSearch($conn);
    $eventoSearch->buscarEventos($_GET['busca']);

    $conn->close();
}
?>
