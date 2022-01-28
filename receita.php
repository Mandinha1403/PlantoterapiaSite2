<?php

require_once 'db_connect.php';

session_start(); 


$sql= "SELECT * FROM post";
$resultado = pg_query($connect, $sql);
$rows = pg_num_rows($resultado);

for($i = 1; $i <= $rows; $i++){
    if($_GET['ap'] == $i):
        $_SESSION['numero_post'] = $i;
    endif;
}

// Código para deletar a planta
if(isset($_POST['btn-deletar'])):
    $numero_receita = $_SESSION['numero_post'];
    $sql="DELETE FROM post WHERE id_post=3";
    $resultado = pg_query($connect, $sql);

    $numero_novo = $numero_receita;

    // Muda a id de todas as outras plantas depois da planta deletada para um número abaixo do anterior
    for($j = $numero_receita + 1; $j <= $rows; $j++) {
        $sql="UPDATE post SET id_post='$numero_novo' WHERE id_post='$j'";
        $resultado = pg_query($connect, $sql);
        $numero_novo++;
    }

     // Fecha a conexão depois de armazenar os dados
     pg_close($connect);

    header('Location: receitas.php');	
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

        <div class="planta_especifico">

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"> 
            <button type="submit" name="btn-deletar"> Deletar Receita </button>
            </form>

            <?php

            require_once 'db_connect.php';

            $numero_receita = $_SESSION['numero_post'];


            // Pega a foto da planta
            $sql= "SELECT foto_post FROM post WHERE id_post='$numero_receita'";
            $foto = pg_query($connect, $sql);

            // Pega o nome da planta
            $sql= "SELECT nome_post FROM post WHERE id_post='$numero_receita'";
            $resultado = pg_query($connect, $sql);
            $nome = pg_fetch_array($resultado)[0];

            // Pega as informações da planta
            $sql= "SELECT descricao_post FROM post WHERE id_post='$numero_receita'";
            $resultado = pg_query($connect, $sql);
            $informacoes = pg_fetch_array($resultado)[0];

            echo "
            <div class='imagem'> <img src='foto.jpeg'>  </div> 
            <div class='nome'> <p> $nome </p> </div>
            <div class='texto'> <p> $informacoes </p> </div>"

            ?>

        </div>

        <?php include "./footer.html" ?>

    </body>
    
</html>
