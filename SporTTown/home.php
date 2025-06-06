<?php
require_once('protected.php'); // Protege com base na sessão correta

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esporte Town</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style_home.css">
</head>
<body class="bg-dark text-white pb-5">

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

    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="Imagens/Zenir.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="Imagens/Zenir.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="Imagens/Zenir.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
</div>

    <div class="container">
        <a href="">
        <div class="event-card d-flex align-items-center">
            <img src="Imagens/" class="me-3" >
            <div>
                <strong>Futebol</strong>
                <br>
                <small>localização</small>
            </div>
        </div>
    </a>
        <a href="esporte.php" >
        <div class="event-card d-flex align-items-center">
            <img src="Imagens/basquete.png" class="me-3" alt="Evento 1">
            <div class="select">
                <strong>Basquete</strong>
                <br>
                <small>localização</small>
            </div>
        </div>
        </a>
        <a href="">
        <div class="event-card d-flex align-items-center">
            <img src="Imagens/tenis de mesa.png" class="me-3" alt="Evento 2">
            <div>
                <strong>Tênis de mesa</strong><br>
                <small>localização</small>
            </div>
        
        </div>
        </a>
        <a href="">
        <div class="event-card d-flex align-items-center">
            <img src="Imagens/vôlei.png" class="me-3" alt="Evento 3">
            <div>
                <strong>Vôlei</strong><br>
                <small>localização</small>
            </div>
        </div>
        </a>
<div class="barra">
    <nav class="bottom-nav d-flex justify-content-around py-2">
        <a href="#" class="nav-link text-center">
            <div>
              <img src="Imagens/home.png">
            </div>
            <small>Home</small>
        </a>
        <a href="#" class="nav-link text-center">
            <div>
                <img src="Imagens/lupa.png" >
            </div>
            <small>Pesquisar</small>
        </a>
        <a href="config.php" class="nav-link text-center">
            <div>
              <img src="Imagens/configuraçoes.png">
            </div>
            <small>Ajustes</small>
        </a>
    </nav>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
