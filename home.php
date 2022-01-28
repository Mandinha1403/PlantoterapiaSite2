<?php

require_once 'db_connect.php';

session_start();

$layout = 0;

// Verifica se na hora de clicar o botão "criar", todos os campos foram preenchidos
if(isset($_POST['btn-pesquisar'])):
    $erros = array();
    $pesquisa = pg_escape_string($connect, $_POST['pesquisa']);
    echo $pesquisa;

    $sql="SELECT * FROM planta WHERE nome_planta='$pesquisa'";
    $resultado_plantas = pg_query($connect, $sql);
    $numero_plantas = pg_num_rows($resultado_plantas);

    $nome_planta = pg_fetch_array($resultado_plantas)[$i];

    $layout = 1;

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


      <div class="header_posts">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"> 
        <input type="text" placeholder="Pesquisar..." name="pesquisa">
        <button type="submit" id="pesquisar" name="btn-pesquisar"> Pesquisar </button>
        <a href="adicionarplanta.php"> <button type="adicionar_planta" id="adicionar_planta"> Adicionar Planta </button> </a>
        </form>
      </div>

      <div class="plantas">

            <ul class="lista_plantas">

                <?php

                if($layout == 0){
                    for($i = 1; $i <= $numero_plantas; $i++){
                        $sql= "SELECT * FROM planta";
                        $resultado = pg_query($connect, $sql);
                        $rows = pg_num_rows($resultado);

                        for($i = 1; $i <= $rows; $i++){
                            $sql= "SELECT nome_planta FROM planta WHERE id_planta='$i'";
                            $resultado = pg_query($connect, $sql);
                            $nome = pg_fetch_array($resultado)[0];

                            $sql= "SELECT foto_planta FROM planta WHERE id_planta='$i'";
                            $foto = pg_query($connect, $sql);
                        
                        
                            echo 
                            "<article> <li> <div class='planta'> 
                                
                                <div class='imagem'> <a href='planta.php?ap=$i'> <img src=''> </a> </div> 
                                <div class='texto'> <a href='planta.php?ap=$i'> $nome </a> </div>
                            
                            </div> </li> </article>";
                        
                        }
                    }
                }

                if($layout == 1){

                    echo $resultado_plantas;
                    /*
                    $erros = array();
                    $pesquisa = pg_escape_string($connect, $_POST['pesquisa']);

                    $sql="SELECT * FROM planta WHERE nome_planta='$pesquisa'";
                    $resultado_plantas = pg_query($connect, $sql);
                    $numero_plantas = pg_num_rows($resultado_plantas);

                    $layout = 1;
                    */

                    /*
                    for($i = 1; $i <= $numero_plantas; $i++){
    

                        $sql= "SELECT foto_planta FROM planta WHERE id_planta='$i'";
                        $foto_planta = pg_query($connect, $sql);
                    
                    
                        echo 
                        "<article> <li> <div class='planta'> 
                            
                            <div class='imagem'> <a href='planta.php?ap=$idplanta'> <img src=''> </a> </div> 
                            <div class='texto'> <a href='planta.php?ap=$idplanta'> $nome_planta </a> </div>
                        
                        </div> </li> </article>";
                    
                    }*/
                }
                
            

                ?>

               
            </ul>
        </div>

        <?php include "./footer.html" ?>

    </body>

</html>
