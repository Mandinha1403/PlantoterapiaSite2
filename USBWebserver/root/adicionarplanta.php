<?php

require_once 'db_connect.php';

session_start();

// Verifica se na hora de clicar o botão "criar", todos os campos foram preenchidos
if(isset($_POST['btn-criar'])):
	$erros = array();
	$foto = mysqli_escape_string($connect, $_POST['planta']);
	$nome = mysqli_escape_string($connect, $_POST['nomeplanta']);
    $informacoes = mysqli_escape_string($connect, $_POST['informacoes']);
	
      

	if(empty($foto) or empty($nome) or empty($informacoes)):
		$erros[] = "Todos os campos precisam estar preenchidos";

    else:

        if (!preg_match("/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/", $nome)):
            $erros[] = "O nome pode ter apenas letras e espaçps";
        
        
        else:

            // Sanitiza o nome da planta e as informações sobre ela
            $nome = filter_var($nome, FILTER_SANITIZE_STRING);
            $informacoes = filter_var($informacoes, FILTER_SANITIZE_STRING);

            // Descobre número de plantas já existentes
            $sql="SELECT * FROM planta";
            $resultado = mysqli_query($connect, $sql);
            $numero_plantas = mysqli_num_rows($resultado) + 1;

            $sql="INSERT INTO planta(descricao_planta, foto_planta, id_planta, nome_planta) VALUES ('$informacoes', '$planta', '$numero_plantas', '$nome')";
            
            mysqli_query($connect, $sql);
    
            // Fecha a conexão depois de armazenar os dados
            mysqli_close($connect);
    
            header('Location: home.php');	

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

        <?php include "./header.html" ?>

        <div class="adicionarplanta">

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
            <div class="item"> <input type="file" id="uploadfotoplanta" name="planta" accept="image/png, image/jpeg" onchange="readURL(this);"> </div>
            <div class="item"> <input type="text" id="nomeplanta" name="nomeplanta" placeholder="Insira o nome da planta"> </div>
            <div class="item"> <textarea name="informacoes" cols="40" rows="10" placeholder="Insire as informações sobre a planta"></textarea> </div>
            <div class="item"> <button type="submit" name="btn-criar"> Criar </a> </button> </div>
        
        </div>
        

        <?php include "./footer.html" ?>

    </body>

</html>