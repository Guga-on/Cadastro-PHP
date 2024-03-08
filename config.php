<?php
    $DBhost = 'localhost';
    $DBuser = 'root';
    $DBpassword = '';
    $DBname = 'cadastro_usuario';
    
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone']; 
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
   
    // Validação do CPF
    function validaCPF($cpf) 
    {
        $cpf= preg_replace('/[^0-9]/','', $cpf);

        if(strlen($cpf) != 11) {
            return false;
        }
        
        if(preg_match('/(\d)\1{10}/',$cpf)){
            return false;
        }
        
        $soma = 0;
        for ($i = 0; $i < 9; $i++) {
            $soma += ($cpf[$i] * (10 - $i));
        }
        $resto = $soma % 11;
        $dv1 = ($resto < 2) ? 0 : 11 - $resto;

        $soma = 0;
        for ($i = 0; $i < 10; $i++) {
            $soma += ($cpf[$i] * (11 - $i));
        }
        $resto = $soma % 11;
        $dv2 = ($resto < 2) ? 0 : 11 - $resto;
        
        if ($cpf[9] != $dv1 || $cpf[10] != $dv2) {
            return false;
        }

        return true;
    }
    //validação do email
    function validaEMAIL($email) 
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            return true;
        }
        return false;
    }
    //validação do tel
    function validaTEL($telefone) 
    {
        // Remove todos os caracteres que não sejam dígitos
        $telefone = preg_replace('/\D/', '', $telefone);
            
        // Verifica se o número de telefone tem pelo menos 10 dígitos
        if(strlen($telefone) < 10 || strlen($telefone) > 12) 
        {
            return false;
        }
        return true;
    }
    if (!validaCPF($cpf))
    {
        echo 'CPF invalido!';
        exit;
    }
    if (!validaEMAIL($email))
    {
        echo 'EMAIL invalido!';
        exit;
    }
    if (!validaTEL($telefone))
    {
        echo 'TELEFONE invalido!';
        exit;
    }


    //link com o banco de dados
    $conexao = new mysqli($DBhost, $DBuser, $DBpassword, $DBname);
    
    if ($conexao->connect_error) 
    {
        die("Falha na conexão: " . $conexao->connect_error); 
    }
    
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);
    $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
    $endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);

    // Inserção dos dados no banco de dados
    $query = $conexao->prepare("INSERT INTO usuarios (nome, email, cpf, telefone, endereco) VALUES (?, ?, ?, ?, ?)");
    $query->bind_param("sssss", $nome, $email, $cpf, $telefone, $endereco);

    if ($query->execute()) 
    {
        echo "Cadastro realizado com sucesso!";
    } 
    else 
    {
        echo "Erro ao cadastrar: " . $conexao->error;
    }
    $query->close();
    $conexao->close();
?>