<?php

require_once 'db_connect.php';

session_start();

// Verifica se na hora de clicar o botão "entrar", todos os campos foram preenchidos
if (isset($_POST['btn-entrar'])):
	//echo "Clicou";
	$erros = array();
	$login = mysqli_escape_string($connect, $_POST['login']);
	$senha = mysqli_escape_string($connect, $_POST['senha']);
	
	
	if(empty($login) or empty($senha)):
		$erros[] = "Os campos login e senha precisam ser preenchido";

    else:

        // Sanitiza o email
        $login = filter_var($login, FILTER_SANITIZE_EMAIL);

        // Valida o email
        if (!filter_var($login, FILTER_VALIDATE_EMAIL)):
            $erros[] = "Email inválido";
        
        else:

            // Sanitiza a senha
            $senha = filter_var($senha, FILTER_SANITIZE_STRING);

            // Codifica a senha em md5
            $senha = md5($senha);
            
            $sql= "SELECT * FROM conta WHERE email='$login' AND senha='$senha'";
            
            $resultado = mysqli_query($connect, $sql);

            // Fecha a conexão depois de armazenar os dados
            mysqli_close($connect);
            
            // Número de linhas do resultado da query maior que 0 ou Se houver algum registro na tabela
            if (mysqli_num_rows($resultado) > 0):
                $dados=mysqli_fetch_array($resultado);
                // Comando que redireciona para página home.php
                header('Location: home.php');		
            
            else:
                $erros[]="Usuário e senha não conferem.";

            endif;

		endif;

	endif;	

endif;	

?>


<!DOCTYPE html>
<html>

    <head>
        <link href="css/styles.css" rel="stylesheet">
        <meta charset="utf-8">
        <title> Plantoterapia </title>
    </head>

    <body>

        <div class="login" >
             
            <div class="content">      
              <!--FORMULÁRIO DE LOGIN-->
                <div id="login">
                    
                    <div class="aviso">
                        <?php
                            if(!empty($erros)):
                                foreach($erros as $erro):
                                    echo $erro;
                                endforeach;
                            endif;
                        ?>
                    </div>

                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"> 
                        <h1> Login </h1>

                        <p> 
                            <label for="email_login"> E-mail </label>
                            <input id="email_login" name="login" type="text" placeholder="Digite seu e-mail"/>
                        </p>
                        
                        <p> 
                            <label for="senha_login"> Senha</label>
                            <input id="senha_login" name="senha" type="password" placeholder="Digite sua senha" /> 
                        </p>
                        
                        <p> 
                            <button type="submit" name="btn-entrar"> Entrar </a> </button>
                        </p>
                        
                        <p class="link">
                            Ainda não tem conta?
                            <a href="cadastro.php"> Registrar-se </a>
                        </p>

                    </form>

                </div>

            </div>

        </div>

        <?php include "./footer.html" ?>

    </body>

</html>