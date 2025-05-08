<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/style_estudante.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>

<?php if(isset($_GET['sucesso'])): ?>
        <p style="color: black;">Estudante cadastrado com sucesso!</p>
    <?php endif; ?>
   
  <div class="form-wrapper">
    <div class="container" id="aluno">
      <div class="form-box">
        <div class="form-header">
          <h1>Cadastro Aluno</h1>
        </div>
        <form action="router.php?rota=cadastrar" method="POST">
        <h3>Dados do Estudante</h3>
    <input type="text" name="matricula" placeholder="Matrícula">
    <input type="text" name="nome" placeholder="Nome">
    <input type="text" name="curso" placeholder="Curso">
    <input type="number" name="ano_ingresso" placeholder="Ano de Ingresso">

    <h3>Dados do Responsável</h3>
    <input type="text" name="responsavel_nome" placeholder="Nome do Responsável">
    <input type="text" name="responsavel_contato" placeholder="Contato">
    <input type="text" name="responsavel_parentesco" placeholder="Parentesco">
          
          <input type="submit" value="Avançar">
        </form>
      </div>
    </div>
</div>
   
  <button onclick="window.location.href='index.php'">Voltar ao Menu</button>

</body>
</html>
</html>