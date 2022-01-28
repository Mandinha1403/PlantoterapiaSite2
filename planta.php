<?php

require_once 'db_connect.php';

session_start(); 


$sql= "SELECT * FROM planta";
$resultado = pg_query($connect, $sql);
$rows = pg_num_rows($resultado);

for($i = 1; $i <= $rows; $i++){
    if($_GET['ap'] == $i):
        $_SESSION['numero_planta'] = $i;
    endif;
}

// Código para deletar a planta
if(isset($_POST['btn-deletar'])):
    $numero_planta = $_SESSION['numero_planta'];
    $sql="DELETE FROM planta WHERE id_planta='$numero_planta'";
    $resultado = pg_query($connect, $sql);

    $numero_novo = $numero_planta;

    // Muda a id de todas as outras plantas depois da planta deletada para um número abaixo do anterior
    for($j = $numero_planta + 1; $j <= $rows; $j++) {
        $sql="UPDATE planta SET id_planta='$numero_novo' WHERE id_planta='$j'";
        $resultado = pg_query($connect, $sql);
        $numero_novo++;
    }

     // Fecha a conexão depois de armazenar os dados
     pg_close($connect);

    header('Location: home.php');	
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
            <button type="submit" name="btn-deletar" id="deletar"> Deletar Planta </button>
            </form>


            <a href="estruturasquimicas.php"> <button type="button" class="posts"> Estruturas Quimicas </button> </a>
            <a href="modosplantio.php"> <button type="button" class="posts"> Modos de Plantio </button> </a>
            <a href="receitas.php"> <button type="button" class="posts"> Receitas </button> </a>

            <?php

            require_once 'db_connect.php';

            $numero_planta = $_SESSION['numero_planta'];


            // Pega a foto da planta
            $sql= "SELECT foto_planta FROM planta WHERE id_planta='$numero_planta'";
            $foto = pg_query($connect, $sql);

            // Pega o nome da planta
            $sql= "SELECT nome_planta FROM planta WHERE id_planta='$numero_planta'";
            $resultado = pg_query($connect, $sql);
            $nome = pg_fetch_array($resultado)[0];

            // Pega as informações da planta
            $sql= "SELECT descricao_planta FROM planta WHERE id_planta='$numero_planta'";
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
