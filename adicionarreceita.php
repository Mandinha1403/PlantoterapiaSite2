<?php

require_once 'db_connect.php';

session_start();

// Verifica se na hora de clicar o botão "criar", todos os campos foram preenchidos
if(isset($_POST['btn-criar'])):
    $erros = array();
    $foto = pg_escape_string($connect, $_POST['planta']);
    $nome = pg_escape_string($connect, $_POST['nomeplanta']);
    $informacoes = pg_escape_string($connect, $_POST['informacoes']);

	if(empty($foto) or empty($nome) or empty($informacoes)):
		$erros[] = "Todos os campos precisam estar preenchidos";

    else:

        if (!preg_match("/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/", $nome)):
            $erros[] = "O nome pode ter apenas letras e espaços";
        
        
        else:

            
            $nome = filter_var($nome, FILTER_SANITIZE_STRING);

            // Descobre número de posts já existentes
            $sql="SELECT * FROM post";
            $resultado = pg_query($connect, $sql);
            $numero_plantas = pg_num_rows($resultado) + 1;

            $tipopost = 3;
            $id_planta = $_SESSION['numero_planta'];

            $sql="INSERT INTO post(id_post, id_planta, id_tppost, nome_post, descricao_post, foto_post) VALUES ('$numero_plantas', '$id_planta', '$tipopost', '$nome', '$informacoes', '$foto');";
            pg_query($connect, $sql);
    
            // Fecha a conexão depois de armazenar os dados
            pg_close($connect);
    
            header('Location: receitas.php');	

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
            <div class="item"> <input type="text" id="nomeplanta" name="nomeplanta" placeholder="Insira o nome da receita"> </div>
            <div class="item"> <textarea name="informacoes" cols="40" rows="10" placeholder="Insire as informações sobre a receita"></textarea> </div>
            <div class="item"> <button type="submit" name="btn-criar"> Criar </a> </button> </div>
        
        </div>
        

        <?php include "./footer.html" ?>

    </body>

</html>
