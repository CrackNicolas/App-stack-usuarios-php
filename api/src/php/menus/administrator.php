<?php
    session_start();
    $tipo_usuario = $_SESSION['tipo_de_usuario'];
    if($_SESSION["usuario"]!=''){
        ?>
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximun-scale=1.0,minimum-scale=1.0">
                    <link id="icon-favicon" rel="icon" href="../../../public/images/logo.png" type="image/png"/>
                    <link rel="stylesheet" href="../../../public/styles/main.css">
                    <!-- CDN Bootstrap -->
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
                    <title>Stack</title>
                </head>
                <body>
                    <div class="menu row row-cols-1 row-cols-md-<?php echo ($tipo_usuario=="Administrador")? "3":"2" ?> px-3 mx-auto">
                        <?php
                            if($tipo_usuario=="Administrador"){
                                ?> 
                                    <a href="../searches/search.php" class="col items-menu">
                                        <div>
                                            <ion-icon name="people-outline"></ion-icon>
                                            <p>Administracion</p>
                                        </div>
                                    </a>
                                <?php
                            }
                        ?>
                        <?php
                            require_once("../../../config/connection.php");
                            require_once("../../../config/queries.php");
                        ?>
                        <?php
                            if($tipo_usuario=="Administrador"){
                                ?> 
                                    <a href="../searches/results.php" class="col items-menu">
                                        <div>
                                            <ion-icon name="people-outline"></ion-icon>
                                            <p>Resultados</p>
                                        </div>
                                    </a>
                                <?php
                            }else{
                                ?>
                                    <a href="../questions/<?php echo (sql_Buscar_revision($conexion,$_SESSION['id_usuario']))? "review.php" : "design.php" ?> " class="col items-menu">
                                        <div>
                                            <ion-icon name="reader-outline"></ion-icon>
                                            <p>Cuestionario</p>
                                        </div>
                                    </a>
                                <?php
                            }
                        ?>
                        <a href="../main/close_session.php" class="col items-menu">
                            <div>
                                <ion-icon name="walk-outline"></ion-icon>
                                <p>Cerrar sesion</p>
                            </div>
                        </a>
                    </div>
                </body>
                <!-- CDN Iconos -->
                <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
                <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
            </html>
        <?php
    }else{
        header("location:../../../index.html");
    }
?>