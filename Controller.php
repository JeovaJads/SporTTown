<?php

require_once __DIR__ . '/../models/Model.php'; // Caminho absoluto, evita erros com níveis de diretórios

class Controller {
private $model;

public function __construct(){
    $this->model = new Model(); 
}

public function cadastrar() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $this->model->salvar($nome, $email, $senha);

        header("Location: cadastros/cadastrar.php?sucesso=1");
        exit();

    }
}

public function empresa() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $cnpj = $_POST["cnpj"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $this->model->Empresar($nome, $cnpj, $email, $senha);

        header("Location: cadastros/empresa.php?sucesso=1");
        exit;
    }
}

public function camps() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start(); // Inicia a sessão
        
        // Recupera dados da empresa logada da sessão
        $empresa_nome_sessao = $_SESSION['empresa_nome'] ?? '';
        $empresa_email_sessao = $_SESSION['empresa_email'] ?? '';
        $empresa_cnpj_sessao = $_SESSION['empresa_cnpj'] ?? '';

        // Dados do formulário
        $nome = $_POST["nome"];
        $cnpj = $_POST["cnpj"];
        $nome_dono = $_POST["nome_dono"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $nicho = $_POST["nicho"];
        $logradouro = $_POST["logradouro"];
        $cidade = $_POST["cidade"];
        $cep = $_POST["cep"];
        $estado = $_POST["estado"];
        $bairro = $_POST["bairro"];
        $target_file = $_FILES['arquivo'];

        // Verifica se os dados do formulário batem com a sessão
        if ($nome_dono !== $empresa_nome_sessao || 
            $email !== $empresa_email_sessao || 
            $cnpj !== $empresa_cnpj_sessao) {
            die("Dados da empresa não coincidem com o usuário logado.");
        }

        if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
            require_once __DIR__ . '/../models/upload.php';
            $caminhoSeguro = fazerUpload($_FILES['arquivo']);
        } else {
            die("Erro no envio do arquivo.");
        }

        if (!$this->model->empresaExiste($nome_dono, $email, $senha, $cnpj)) {
            die("Empresa não encontrada ou dados incorretos.");
        }

        // Cadastra o campeonato
        $this->model->Campar(
            $nome,
            $nome_dono,
            $cnpj,
            $email,
            $senha,
            $nicho,
            $cep,
            $logradouro,
            $cidade,
            $bairro,
            $estado,
            $caminhoSeguro
        );

       
        // CRIAÇÃO DO ARQUIVO DO CAMPEONATO

        $diretorio = "C:/Apache24/htdocs/SporTTown/Corpos/";
        $nomeSanitizado = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nome);
        $arquivo = $diretorio . $nomeSanitizado . ".php";

        $conteudo = <<<PHP
        <?php
        // Aqui deve aparacer: Página do campeonato: $nome
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        include('../models/Model.php');
        \$model = new Model();
        \$pdo = \$model->getConnect();

        // Recupera dados da sessão
        \$nome = \$_SESSION['empresa_nome'] ?? '';
        \$email = \$_SESSION['empresa_email'] ?? '';
        \$cnpj = \$_SESSION['empresa_cnpj'] ?? '';

        require_once('../configs/protected.php');
        ?>

        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="icon" type="image/png" href="../Imagens/favicon.png">
            <title>$nome</title>
            <link rel="stylesheet" href="../css/style.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        </head>
        <body>
            <div class="profile-section">
                <div class="profile-text">
                    <strong><?= htmlspecialchars(\$nome) ?></strong><br>
                    <small><?= htmlspecialchars(\$email) ?></small><br>   
                    <?php if (isset(\$_SESSION['empresa_cnpj'])): ?>
                        <small>CNPJ: <?= htmlspecialchars(\$cnpj) ?></small><br>
                    <?php endif; ?>
                    <a href="../login/logout.php" class="sair"> <small>Sair</small> </a>
                </div>
            </div>
        </body>
        </html>
        PHP;

        if (!file_exists($arquivo)) {
            if (file_put_contents($arquivo, $conteudo) !== false) {
                // Apenas para debug: você pode remover esse echo depois
                echo "Arquivo criado: " . $arquivo;
            } else {
                die("Erro ao criar o arquivo.");
            }
        }

        

        header("Location: cadastros/camps.php?sucesso=1");
        exit;
    }
}

public function painel() {
    // inicia sessão e verifica login, se necessário…
    session_start();
    // busca todos os camps
    $camps = $this->model->getAllCamps();

    // aqui você pode passar $camps para a view,
    // em puro PHP seria algo como:
    include __DIR__ . '/../views/painel.php';
}


public function listar() {
    return $this->model->buscarTodosCampeonatos();
}

public function buscarCampeonatosPorFiltros($nome, $nicho) {
    // Se nicho estiver vazio, passe uma string vazia para o model
    return $this->model->buscarCampeonatosPorNome($nome, $nicho ?? '');
}


public function buscarPorNome($nome) {
    try {
        $stmt = $this->pdo->prepare("SELECT * FROM camps WHERE nome = :nome");
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ); // Retorna um objeto com todos os campos
    } catch (PDOException $e) {
        die("Erro ao buscar campeonato: " . $e->getMessage());
    }
}

public function deletar() {
    try {
        if (!isset($_GET['nome'])) {
            throw new Exception("Nome do campeonato não fornecido");
        }
        
        $nome = $_GET['nome'];
        $campeonato = $this->model->buscarCampeonatoPorNome0909($nome);
        
        if (!$campeonato) {
            throw new Exception("Campeonato não encontrado: $nome");
        }
        
        // 1. Excluir imagem
        $imagemExcluida = false;
        if (!empty($campeonato->caminho_imagem)) {
            $caminhoAbsoluto = realpath(__DIR__ . '/../' . $campeonato->caminho_imagem);
            
            if ($caminhoAbsoluto && file_exists($caminhoAbsoluto)) {
                if (unlink($caminhoAbsoluto)) {
                    $imagemExcluida = true;
                } else {
                    throw new Exception("Falha ao excluir imagem: " . $caminhoAbsoluto);
                }
            } else {
                throw new Exception("Imagem não encontrada: " . $caminhoAbsoluto);
            }
        }
        
        // 2. Excluir registro do banco
        if (!$this->model->deletarCampeonato($nome)) {
            throw new Exception("Falha ao excluir do banco de dados");
        }
        
        // 3. Excluir arquivo PHP
        $nomeSanitizado = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nome);
        $arquivoCorpo = realpath(__DIR__ . '/../Corpos/' . $nomeSanitizado . '.php');
        
        if ($arquivoCorpo && file_exists($arquivoCorpo)) {
            if (!unlink($arquivoCorpo)) {
                throw new Exception("Falha ao excluir arquivo do campeonato");
            }
        }
        
        // Sucesso - redireciona
        header("Location: /SporTTown/router.php?rota=listar&sucesso=1");
        exit;
        
    } catch (Exception $e) {
        // Mostra erro detalhado
        die("<h1>ERRO</h1><pre>" . $e->getMessage() . "</pre>");
    }
}
  

public function atualizar() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start();
        
        try {
            // Validação básica
            if (empty($_POST['nome_original'])) {
                throw new Exception("Nome original do campeonato é obrigatório");
            }

            // Captura todos os campos do formulário
            $nome_original = $_POST["nome_original"];
            $nome = $_POST["nome"];
            $nome_dono = $_POST["nome_dono"];
            $cnpj = $_POST["cnpj"];
            $email = $_POST["email"];
            $senha = $_POST["senha"];
            $nicho = $_POST["nicho"];
            $cep = $_POST["cep"];
            $logradouro = $_POST["logradouro"];
            $cidade = $_POST["cidade"];
            $bairro = $_POST["bairro"];
            $estado = $_POST["estado"];

            // Verifica se a senha está correta
            if (!$this->model->empresaExiste($nome_dono, $email, $senha, $cnpj)) {
                $_SESSION['erro'] = "Senha incorreta!";
                header("Location: /SporTTown/Ações/editCamp.php?nome=" . urlencode($nome_original));
                exit;
            }

            // Atualiza no banco de dados
            if ($this->model->atualizarCampeonato($nome_original, $nome, $nome_dono, $cnpj, $email, $senha, $nicho, $cep, $logradouro, $cidade, $bairro, $estado)) {
                $_SESSION['sucesso'] = "Campeonato atualizado com sucesso!";

                // Renomear o arquivo se o nome foi alterado
                if ($nome_original !== $nome) {
                    $diretorio = "C:/Apache24/htdocs/SporTTown/Corpos/";
                    $nomeSanitizadoOriginal = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nome_original);
                    $nomeSanitizadoNovo = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nome);
                    
                    $arquivoOriginal = $diretorio . $nomeSanitizadoOriginal . ".php";
                    $arquivoNovo = $diretorio . $nomeSanitizadoNovo . ".php";

                    if (file_exists($arquivoOriginal)) {
                        if (!rename($arquivoOriginal, $arquivoNovo)) {
                            throw new Exception("Falha ao renomear o arquivo do campeonato.");
                        }
                    }
                }
            } else {
                throw new Exception("Falha ao atualizar no banco de dados");
            }
            
            // Redireciona para a lista
            header("Location: /SporTTown/router.php?rota=listar");
            exit;
            
        } catch (Exception $e) {
            // Log do erro
            error_log("Erro na atualização: " . $e->getMessage());
            
            // Guarda o erro na sessão e redireciona
            $_SESSION['erro'] = "Erro ao atualizar: " . $e->getMessage();
            header("Location: /SporTTown/Ações/editCamp.php?nome=" . urlencode($_POST['nome_original']));
            exit;
        }
    }
}

public function buscarDadosCompletos($nome) {
    return $this->model->buscarPorNome($nome);
}

}
