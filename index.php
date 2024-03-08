<?php
    
    if(isset($_POST['submit']))
    {
        include_once('config.php');

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $cpf = $_POST['cpf'];
        $endereco = $_POST['endereco'];

        $result = mysqli_query($conexao,"INSERT INTO usuarios(nome,email,telefone,cpf,endereco) VALUES('$nome','$email','$telefone','$cpf','$endereco')");
        if($result)
        {
            echo "Dados inseridos com sucesso.";
        }
        else
        {
            echo "Erro ao inserir dados: " . mysqli_error($conexao);
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Cadastro</title>
</head>
<body>
    <div class="box">
        <form action="index.php" method='POST'>
            <fieldset>
                <legend><b>Cadastro</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelInput">Nome completo</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" required>
                    <label for="email" class="labelInput">Email</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" maxle required>
                    <label for="telefone" class="labelInput">Telefone</label>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="cpf" id="cpf" class="inputUser" required>
                    <label for="cpf" class="labelInput">Cpf</label>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="endereco" id="endereco" class="inputUser" required>
                    <label for="endereco" class="labelInput">Endereço</label>
                <br><br>
                <input type="submit" name="submit" id="submit">
            </fieldset>
        </form>
    </div>

    <script>
    document.getElementById('cpf').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos

        if (value.length > 3) {
            // Adiciona um ponto após o terceiro dígito
            value = value.substring(0, 3) + '.' + value.substring(3);
        }

        if (value.length > 7) {
            // Adiciona um ponto após o sétimo dígito
            value = value.substring(0, 7) + '.' + value.substring(7);
        }

        if (value.length > 11) {
            // Adiciona um traço após o décimo primeiro dígito
            value = value.substring(0, 11) + '-' + value.substring(11);
        }

        e.target.value = value;
    });
    document.getElementById('telefone').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove todos os caracteres não numérico
        if (value.length > 2 && value.length <= 10) 
        {
            value = '(' + value.substring(0, 2) + ')' + value.substring(2, 6) + '-' + value.substring(6, 11);
        }
        else 
        {
            value = '(' + value.substring(0, 2) + ')' + value.substring(2, 7) + '-' + value.substring(7, 11);
        }
        e.target.value = value;
    });
</script>
</body>
</html>