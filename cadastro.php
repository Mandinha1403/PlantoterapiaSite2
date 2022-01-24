<?php

require_once 'db_connect.php';

session_start();

// Verifica se na hora de clicar o botão "criar", todos os campos foram preenchidos
if (isset($_POST['btn-criar'])):
  //echo "Clicou";
  $erros = array();
  $login = pg_escape_string($connect, $_POST['login']);
  $senha = pg_escape_string($connect, $_POST['senha']);
  $senha_conf = pg_escape_string($connect, $_POST['senha_conf']);
	

  if(empty($login) or empty($senha) or empty($senha_conf)):
      $erros[] = "Todos os campos precisam ser preenchidos";

  else:
      $sql = "SELECT email FROM conta WHERE email='$login'";
      $usuario_existe = pg_query($connect, $sql);

      // Verifica se o usuário já existe
      if(pg_num_rows($usuario_existe) > 0):
      	    $erros[] = "Usuário já existe";
      // Verifica se a senha foi confirmada corretamente
      else:
	    if(($senha) != ($senha_conf)):
	      $erros[] = "As senhas estão diferentes";

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

		$sql="INSERT INTO conta(email, senha) VALUES ('$login', '$senha')";

		pg_query($connect, $sql);

		// Fecha a conexão depois de armazenar os dados
		pg_close($connect);

		header('Location: home.php');	

	      endif;
	    endif;
	  endif;	
     endif;
endif;	

?>

<!DOCTYPE html>
<html>

    <head>
        <link href="styles.css" rel="stylesheet">
        <meta charset="utf-8">
        <title> Plantoterapia </title>
    </head>

    <body>

      <div class="cadastro">
            
        <div class="content">      
          <!--FORMULÁRIO DE CADASTRO-->
          

          <div id="registrar-se">

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
              <h1>Registrar-se</h1> 
              <p> 
                <label for="email_casatro"> E-mail </label>
                <input id="email-cadastro" name="login" type="text" placeholder="Digite seu e-mail"/>
              </p>
                
              <p> 
                <label for="senha_cadastro"> Senha</label>
                <input id="senha_cadastro" name="senha" type="password" placeholder="Digite sua senha" /> 
              </p>

              <p> 
                <label for="senha_conf_cadastro"> Confirmar Senha</label>
                <input id="senha_conf_cadastro" name="senha_conf" type="password" placeholder="Confirme sua senha" /> 
              </p>
                
              <p> 
                <button type="submit" name="btn-criar"> Criar </a> </button>
              </p>
                
              <p class="link">
                Já tem conta?
                <a href="index.php"> Login </a>
              </p>
            </form>

          </div>
          
        </div>

      </div>

      <?php include "./footer.html" ?>

    </body>

</html>
