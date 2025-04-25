<?php
// Dados de login fixos para exemplo
$usuario_correto = "admin";
$senha_correta = "1234";

// Receber dados do formulário
$usuario = $_POST['username'];
$senha = $_POST['password'];

// Verificar se o login está correto
if ($usuario === $usuario_correto && $senha === $senha_correta) {
    // Redireciona para index.html
    header("Location: index.html");
    exit();
} else {
    // Redireciona de volta pro login com erro
    echo "<script>alert('Usuário ou senha incorretos'); window.location.href = 'login.html';</script>";
}