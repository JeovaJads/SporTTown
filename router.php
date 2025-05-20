<?php
require_once 'controllers/Controller.php';

$controller = new Controller();

$rota = $_GET['rota'] ?? 'listar'; // Se não tiver definida, define com a rota padrão

// Processa requisições POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($rota == 'cadastrar') {
        $controller->cadastrar($_POST);
    } elseif ($rota == 'atualizar') {
        $controller->atualizar();
    } elseif ($rota == 'deletar_responsavel' && isset($_POST['deletar_responsavel'])) {
        $controller->deletarResponsavel((int)$_POST['deletar_responsavel']);
        exit();
    }
exit;
        }
    
    


// Processa requisições GET
switch($rota) {
    case 'cadastrar':
        require_once 'views/estudanteCadastro.php';
        break;
    case 'deletar':
        require_once 'views/listarDeletar.php';
        break;
    case 'atualizar':
        require_once 'views/listarAtualizar.php';
        break; 
    case 'formAtualizar': 
        require_once 'views/formAtualizar.php';
        break; 
    case 'deletar':
        require_once 'views/listarDeletar.php';
        break;
    case 'buscar_responsaveis':
        $controller->buscarResponsaveis($_GET['id']);
        exit;
    case 'confirmarDeletar':
    $controller->deletar($_GET['matricula']);
    exit;
    
    case 'buscar_ajax':
    header('Content-Type: application/json');
    try {
        $nomePesquisa = $_GET['nome'] ?? '';
        $estudantes = $controller->buscarPorNome($nomePesquisa);
        
        $html = '';
        if (!empty($estudantes)) {
            $html .= '<table border="1"><tr><th>Matrícula</th><th>Nome</th><th>Curso</th><th>Ano Ingresso</th><th>Ações</th></tr>';
            foreach ($estudantes as $estudante) {
                $html .= sprintf(
                    '<tr>
                        <td>%s</td><td>%s</td><td>%s</td><td>%s</td>
                        <td><a href="router.php?rota=confirmarDeletar&matricula=%s" onclick="return confirm(\'Tem certeza?\')">Excluir</a></td>
                    </tr>',
                    htmlspecialchars($estudante->matricula),
                    htmlspecialchars($estudante->nome),
                    htmlspecialchars($estudante->curso),
                    htmlspecialchars($estudante->ano_ingresso),
                    $estudante->matricula
                );
            }
            $html .= '</table>';
        } else {
            $html = '<p>'.($nomePesquisa ? 'Nenhum estudante encontrado.' : 'Nenhum estudante cadastrado.').'</p>';
        }
        
        echo json_encode(['success' => true, 'html' => $html]);
    } catch(Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
    exit;

    case 'listar':
    default:
        require_once 'views/listarEstudantes.php';
        break;
}
?>