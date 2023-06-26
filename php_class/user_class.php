<?php
class User {
    private $nome;
    private $email;
    private $senha;
    private $tipo_usuario;

    // Construtor da classe
    public function __construct($nome, $email, $senha, $tipo_usuario) {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->tipo_usuario = $tipo_usuario;
    }

    // Getters
    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    // Setters
    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    //função login
    public function login($email, $senha) {
        if ($email == $this->email && $senha == $this->senha) {
            return true;
        } else {
            return false;
        }
    }
}

