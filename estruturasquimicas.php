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
        </form>
        <a href="adicionarestruturaquimica.php"> <button type="adicionar_planta" id="adicionar_planta"> Adicionar Estrutura Quimica </button> </a>
      </div>

      <div class="plantas">

            <ul class="lista_plantas">

                <?php

                require_once 'db_connect.php';

                session_start();

                $sql= "SELECT * FROM post";
                $resultado = pg_query($connect, $sql);
                $rows = pg_num_rows($resultado);

                for($i = 1; $i <= $rows; $i++){
                    $sql= "SELECT nome_post FROM post WHERE id_post='$i' AND id_tppost=1";
                    $resultado = pg_query($connect, $sql);
                    $nome = pg_fetch_array($resultado)[0];

                    $sql= "SELECT foto_post FROM post WHERE id_post'$i'";
                    $foto = pg_query($connect, $sql);
                
                    
                    if($sql is not null){
                        echo 
                        "<article> <li> <div class='planta'> 
                            
                            <div class='imagem'> <a href='estruturaquimica.php?ap=$i'> <img src=''> </a> </div> 
                            <div class='texto'> <a href='estruturaquimica.php?ap=$i'> $nome </a> </div>
                        
                        </div> </li> </article>";
                    }
                
                }
            
                ?>

               
            </ul>
        </div>

        <?php include "./footer.html" ?>

    </body>

</html>
