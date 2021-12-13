<!DOCTYPE html>
<html>

    <head>
        <link href="css/styles.css" rel="stylesheet">

        <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
        <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

        <meta charset="utf-8">
        <title> Plantoterapia </title>

        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                var reader = new FileReader();
            
                reader.onload = function (e) {
                    $('#fotoplanta').attr('src', e.target.result).width(50).height(50);
                };
            
                reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

    </head>

    <body>

        <?php include "./header.html" ?>

        <div class="adicionarplanta">
            <div class="item"> <img id="fotoplanta" src="#"/> </div>
            <div class="item"> <input type="file" id="uploadfotoplanta" name="planta" accept="image/png, image/jpeg" onchange="readURL(this);"> </div>
            <div class="item"> <input type="text" id="nomeplanta" name="nomeplanta" placeholder="Insira o nome da planta"> </div>
            <div class="item"> <textarea name="informacoes" cols="40" rows="10" placeholder="Insire as informações sobre a planta"></textarea> </div>
            <div class="item"> <button type="button"> <a href="home.html"> Criar </a> </button> </div>
        </div>
        

        <?php include "./footer.html" ?>

    </body>

</html>