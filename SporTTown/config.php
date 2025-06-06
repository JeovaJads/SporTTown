<?php
require_once('protected.php'); // Protege com base na sessão correta

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esporte Town</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style_config.css">
</head>
<body>

    <div class="profile-section">
        <img src="Imagens/usuario.png" >
        <div class="profile-text">
            <strong><?php echo $_SESSION['usuario_nome']; ?></strong><br>
            <small>Esporte Town do usuário</small>
            <a href="logout.php">
                <small>Sair</small>
            </a>
        </div>
    </div>

    <div class="barra">
    <nav class="bottom-nav d-flex justify-content-around py-2">
        <a href="home.php" class="nav-link text-center">
            <div>
              <img src="Imagens/home.png" alt="">
            </div>
            <small>Home</small>
        </a>
        <a href="#" class="nav-link text-center">
            <div>
                <img src="Imagens/lupa.png" >
            </div>
            <small>Pesquisar</small>
        </a>
        <a href="#" class="nav-link text-center">
            <div>
              <img src="Imagens/configuraçoes.png" alt="">
            </div>
            <small>Ajustes</small>
        </a>
    </nav>
</div>
</body>
</html>