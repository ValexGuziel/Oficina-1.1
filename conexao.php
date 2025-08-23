<?php

$host = 'localhost'; // Geralmente 'localhost' para desenvolvimento
$usuario = 'root';   // Seu usuário do banco de dados
$senha = '';         // Sua senha do banco de dados (deixe em branco se não tiver)
$banco = 'oficina';  // Nome do banco de dados que criamos

// Tenta estabelecer a conexão
$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica se a conexão falhou
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Opcional: Define o charset para evitar problemas de acentuação
$conn->set_charset("utf8mb4");

?>