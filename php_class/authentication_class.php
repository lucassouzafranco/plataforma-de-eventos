<?php
class Authentication {
    private $users;

    // Construtor da classe
    public function __construct() {
        $this->users = [];
    }

    // Função de registro de usuário
    public function register($nome, $email, $senha) {
        // Verifica se o email já está em uso
        foreach ($this->users as $user) {
            if ($user['email'] == $email) {
                return false; // Email já existe, o registro falha
            }
        }

        // Cria um novo usuário e adiciona à lista de usuários
        $user = [
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha
        ];
        $this->users[] = $user;

        return true; // Registro bem-sucedido
    }

    // Função de login de usuário
    public function login($email, $senha) {
        // Verifica se as credenciais são válidas
        foreach ($this->users as $user) {
            if ($user['email'] == $email && $user['senha'] == $senha) {
                return true; // Login bem-sucedido
            }
        }

        return false; // Login falha
    }
}


// Criando um objeto de autenticação
$auth = new Authentication();

// Registrando um novo usuário
if ($auth->register("João", "joao@example.com", "senha123")) {
    echo "Registro bem-sucedido!<br>";
} else {
    echo "Email já existe. Registro falhou.<br>";
}

// Tentando fazer login com credenciais válidas
if ($auth->login("joao@example.com", "senha123")) {
    echo "Login bem-sucedido!<br>";
} else {
    echo "Email ou senha inválidos. Login falhou.<br>";
}

// Tentando fazer login com credenciais inválidas
if ($auth->login("joao@example.com", "senha456")) {
    echo "Login bem-sucedido!<br>";
} else {
    echo "Email ou senha inválidos. Login falhou.<br>";
}
