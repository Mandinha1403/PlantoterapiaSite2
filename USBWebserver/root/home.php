<!DOCTYPE html>
<html>

    <head>
        <link href="css/styles.css" rel="stylesheet">
        <meta charset="utf-8">
        <title> Plantoterapia </title>
    </head>

    <body>
        
      <?php include "./header.html" ?>


      <div class="header_posts">

        <input type="text" placeholder="Pesquisar...">
        <button type="pesquisar" id="pesquisar"> Pesquisar </button>
        <button type="adicionar_planta" id="adicionar_planta"> <a href="adicionarplanta.html"> Adicionar Planta </a> </button>

      </div>

      <div class="plantas">

            <ul class="lista_plantas">

                <article> <li> <div class="planta"> 
                    
                    <div class="imagem"> <a href="planta.php"> <img src="imagem\posts\1.jpeg"> </a> </div> 
                    <div class="texto"> <a href="planta.php"> Boldo </a> </div>
                
                </div> </li> </article>

                <article> <li> <div class="planta"> 
                    
                    <div class="imagem"> <a href="planta.php"> <img src="imagem\posts\2.jpeg"> </a> </div> 
                    <div class="texto"> <a href="planta.php"> Cebolinha </a> </div>
                
                </div> </li> </article>

                <article><li> <div class="planta"> 
                    
                    <div class="imagem"> <a href="planta.php"> <img src="imagem\posts\3.jpeg"> </a>  </div> 
                    <div class="texto"> <a href="planta.php"> Pimenta-do-reino </a> </div>
                
                </div> </li> </article>

                <article> <li> <div class="planta"> 
                    
                    <div class="imagem"> <a href="planta.php"> <img src="imagem\posts\4.jpeg"> </a>  </div> 
                    <div class="texto"> <a href="planta.php"> Tomate </a> </div>
                
                </div> </li> </article>

                <article> <li> <div class="planta"> 
                    
                    <div class="imagem"> <a href="planta.php"> <img src="imagem\posts\5.jpeg"> </a> </div> 
                    <div class="texto"> <a href="planta.php"> Alho </a> </div>
                
                </div> </li> </article>

            </ul>
        </div>

        <?php include "./footer.html" ?>

    </body>

</html>