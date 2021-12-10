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
		$erros[] = "<li> O campo login/senha precisa ser preenchido </li>";

    else:
        // Criptografa a senha
        $senha=md5($senha);

        // Usuário: ??? / Senha: ???
        $sql= "SELECT id, login FROM usuarios WHERE login= '$login' AND senha='$senha'";
        
        $resultado = mysqli_query($connect, $sql);

        // Fecha a conexão depois de armazenar os dados
        mysqli_close($connect);
        
        // Número de linhas do resultado da query maior que 0 ou Se houver algum registro na tabela
        if (mysqli_num_rows($resultado) > 0):
            $dados=mysqli_fetch_array($resultado);
            $_SESSION['logado']= true;
            $_SESSION['id_usuario']= $dados['id'];
            // Comando que redireciona para página home.php
            header('Location: home.php');		
        
        else:
            $erros[]="<li>Usuário e senha não conferem.</li>";
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

            <?php
                if(!empty($erros)):
                    foreach($erros as $erro):
                        echo $erro;
                    endforeach;
                endif;
            ?>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"> 
                <h1> Login </h1>

                <p> 
                    <label for="email_login"> E-mail </label>
                    <input id="email_login" name="login" required="required" type="text" placeholder="Digite seu e-mail"/>
                </p>
                
                <p> 
                    <label for="senha_login"> Senha</label>
                    <input id="senha_login" name="senha" required="required" type="password" placeholder="Digite sua senha" /> 
                </p>
                
                <p> 
                    <button type="submit" name="btn-entrar"> <a href="home.html"> Entrar </a> </button>
                </p>
                
                <p class="link">
                    Ainda não tem conta?
                    <a href="registrar-se.html"> Registrar-se </a>
                </p>

            </form>

        </div>


    </body>

</html>