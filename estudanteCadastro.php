<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css ">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap @5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('imagens/home (5).png'); /* Substitua pelo caminho real da imagem */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            overflow: hidden;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
        }

        /* Container do formulário */
        .form-wrapper {
            width: 100%;
            max-width: 700px;
            margin-bottom: 40px;
        }

        .form-box {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Cabeçalho do formulário */
        .form-header h1 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 28px;
            color: #2c3e50;
            font-weight: 600;
        }

        /* Títulos das seções */
        h3 {
            margin-bottom: 15px;
            font-size: 18px;
            color: #34495e;
            border-left: 4px solid #27ae60;
            padding-left: 10px;
        }

        /* Grupo de input com ícone */
        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            pointer-events: none;
        }

        .input-group input {
            width: 100%;
            padding: 12px 40px 12px 40px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            transition: border-color 0.3s ease;
        }

        .input-group input:focus {
            border-color: #27ae60;
            outline: none;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }

        /* Botão de submit */
        input[type="submit"] {
            width: 100%;
            background-color: #2ecc71;
            color: white;
            padding: 14px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #27ae60;
        }

        /* Mensagem de sucesso */
        p {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            color: green;
            margin-bottom: 20px;
            background-color: #d4edda;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #c3e6cb;
        }

        /* Botão Voltar ao Menu */
        button {
            background-color: #7f8c8d;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 15px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #607d8b;
        }
    </style>
</head>

<body>

    <?php if(isset($_GET['sucesso'])): ?>
        <p>Estudante cadastrado com sucesso!</p>
    <?php endif; ?>

    <div class="form-wrapper">
        <div class="container" id="aluno">
            <div class="form-box">
                <div class="form-header">
                    <h1>Cadastro Aluno</h1>
                </div>
                <form action="router.php?rota=cadastrar" method="POST">
                    <h3>Dados do Estudante</h3>

                    <div class="input-group">
                        <i class="fas fa-id-card"></i>
                        <input type="text" name="matricula" placeholder="Matrícula" maxlength="8">
                    </div>

                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" name="nome" placeholder="Nome" maxlength="100">
                    </div>

                    <div class="input-group">
                        <i class="fas fa-book"></i>
                        <input type="text" name="curso" placeholder="Curso" maxlength="50">
                    </div>

                    <div class="input-group">
                        <i class="fas fa-calendar-alt"></i>
                        <input type="number" name="ano_ingresso" placeholder="Ano de Ingresso" min="2000" max="2100">
                    </div>

                    <h3>Dados do Responsável</h3>

                    <div class="input-group">
                        <i class="fas fa-user-tie"></i>
                        <input type="text" name="responsavel_nome" placeholder="Nome do Responsável" maxlength="100">
                    </div>

                    <div class="input-group">
                        <i class="fas fa-phone"></i>
                        <input type="text" name="responsavel_contato" placeholder="Contato" maxlength="19">
                    </div>

                    <div class="input-group">
                        <i class="fas fa-users"></i>
                        <input type="text" name="responsavel_parentesco" placeholder="Parentesco" maxlength="19">
                    </div>

                    <input type="submit" value="Avançar">
                </form>
            </div>
        </div>
    </div>

    <button onclick="window.location.href='index.php'">Voltar ao Menu</button>

</body>
</html>