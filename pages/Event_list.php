<?php
require_once 'data_base/banco_de_dados.php';

// Consultar eventos no banco de dados
$sql_select_events = "SELECT * FROM events";
$result_events = $conn->query($sql_select_events);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Lista de Eventos</title>
</head>
<body>
    <h1>Lista de Eventos</h1>

    <div class="event-list">
        <?php
        if ($result_events->num_rows > 0) {
            while ($row = $result_events->fetch_assoc()) {
                $titulo = $row['titulo'];
                $descricao = $row['descricao'];
                $imagem = $row['imagem'];

                echo '<div class="event-item">';
                echo '<img src="'.$imagem.'" alt="'.$titulo.'">';
                echo '<h2>'.$titulo.'</h2>';
                echo '<p>'.$descricao.'</p>';
                echo '</div>';
            }
        } else {
            echo 'Nenhum evento encontrado.';
        }
        ?>
    </div>
</body>
</html>

<?php
// Fechar a conexão com o banco de dados
$conn->close();
?>
