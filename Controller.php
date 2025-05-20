<?php

require_once __DIR__ . '/../models/Model.php'; // Caminho absoluto, evita erros com níveis de diretórios

class Controller {
private $model;

public function __construct(){
    $this->model = new Model(); 
}

public function create()
{
    return view('estudante.form');
}

public function cadastrar($data)
{
    // Validação simples
    if (
        empty($data['matricula']) || empty($data['nome']) || empty($data['curso']) ||
        empty($data['ano_ingresso']) || empty($data['responsavel_nome']) ||
        empty($data['responsavel_contato']) || empty($data['responsavel_parentesco'])
    ) {
        die("Todos os campos são obrigatórios.");
    }

    $this->model->salvarComResponsavel($data);

    header("Location: router.php?rota=cadastrar&sucesso=1");
    exit;
}


public function listar() {
    return $this->model->buscarEstudantes();
}

public function buscarResponsaveis($id) {
    return $this->model->getResponsaveisPorEstudante($id);
}

public function deletarResponsavel($id) {
    $this->model->deletarResponsavel($id);
    header("Location: router.php?rota=listar_estudantes");
    exit;
}


public function mostrarResponsaveis($idEstudante) {
    $model = new Model();
   $responsaveis = $model->getResponsaveisPorEstudante($idEstudante);

    foreach ($responsaveis as $r) {
        echo "<strong>Nome:</strong> {$r['nome']}<br>";
        echo "<strong>Contato:</strong> {$r['contato']}<br>";
        echo "<strong>Parentesco:</strong> {$r['parentesco']}<hr>";
    }
}



public function deletar($matricula) {
    // 🔎 Busca o estudante para obter o ID
    $estudante = $this->model->getEstudantePorMatricula($matricula);

    if ($estudante) {
        $idEstudante = $estudante->id;

        // 🔄 Primeiro, exclui os responsáveis relacionados a esse estudante
        $this->model->deletarResponsaveisPorEstudante($idEstudante);

        // 🚀 Depois, exclui o estudante
        $this->model->deletarEstudante($matricula);

        header("Location: router.php?rota=cadastrar&sucesso=1");
        exit;
    }
}

public function buscarResponsaveisArray($id) {
    return $this->model->getResponsaveisPorEstudante($id);
}


public function buscarPorNome($nome) {
    return $this->model->buscarEstudantesPorNome($nome);
}

public function buscarPorMatricula($matricula) {
    return $this->model->buscarPorMatricula($matricula);
}



public function buscarSugestoes($termo) {
    return $this->model->buscarSugestoesNome($termo);
}

public function autocomplete($termo) {
    return $this->model->buscarSugestoesNome($termo);
}


public function atualizar() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $matricula = $_POST["matricula"];
        $nome = $_POST["nome"];
        $curso = $_POST["curso"];
        $ano_ingresso = $_POST["ano_ingresso"];

        $this->model->atualizarEstudante($matricula, $nome, $curso, $ano_ingresso);

        header("Location: router.php?rota=cadastrar&sucesso=1");
        exit;
    }
}

}
?>
