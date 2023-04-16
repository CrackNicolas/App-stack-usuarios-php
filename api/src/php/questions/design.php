<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link id="icon-favicon" rel="icon" href="../../../public/images/logo.png" type="image/png"/>
        <link rel="stylesheet" href="../../../public/styles/questions.css">
        <!-- CDN Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <title>Cuestionario</title>
    </head>
    <body>
        <nav class="menu-administrator">
            <a href="../menus/administrator.php">
                <span>Stack</span>
                <ion-icon name="logo-stackoverflow"></ion-icon>
            </a>
            <a href="../main/close_session.php">
                <ion-icon name="walk-outline"></ion-icon>
            </a>
        </nav>
        <div class="questions row row-cols-1 row-cols-md-1 pt-5 px-2 mx-auto">
            <div class="card mb-3 mt-5">
                <div class="card-body">
                    <h4 class="card-title font-bold">
                        Pregunta
                        <?php
                            require_once("../../../config/connection.php");
                            require_once("../../../config/queries.php");
                            session_start();
                            $usuario = $_SESSION['usuario'];
                            sql_Resultados("Inicio",$conexion,$usuario,0);
                            echo $contador = 1;
                            fwrite(fopen("files/contador.txt","w+"),$contador);
                            fclose(fopen("files/contador.txt","r+"));
                        ?>
                    </h4>
                    <?php
                        include("../../../config/connection.php");
                        foreach(sql_Preguntas($conexion,$contador) as $i => $array1){
                    ?>
                    <h6 class="info text-secondary">Sin responder aun Puntua como</h6>
                    <form action="execute.php" method="POST">
                        <p class="question card-text">
                            <?php echo $array1['pregunta']; ?>
                        </p>
                        <input style="display:none"; type="text" name="pregunta" value="<?php echo $array1['pregunta']; ?>">
                        <?php
                            $id = $array1['id'];
                        }?>
                        <p class="card-title mb-1">Seleccione una:</p>
                        <?php
                            foreach(sql_Opciones($id) as $i => $array2){
                        ?>
                        <label class="options card-text"> 
                            <input type="radio" name="opc" value="<?php echo $array2['descripcion']; ?>">
                            <span>
                                <?php echo $array2['descripcion']; ?>
                            </span>
                        </label>
                        <?php } ?>
                        <button class="next text-light" name="Siguiente" type="submit">
                            <span>Siguiente</span>
                            <ion-icon name="chevron-forward-outline"></ion-icon>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <!-- CDN Iconos -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>