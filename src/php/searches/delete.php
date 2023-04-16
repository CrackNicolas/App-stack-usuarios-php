<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link id="icon-favicon" rel="icon" href="../../../public/images/logo.png" type="image/png"/>
        <link rel="stylesheet" href="../../../public/styles/main.css">
        <!-- CDN Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <title>Stack</title>
    </head>
    <body>
        <nav class="menu-administrator">
            <a href="../menus/administrator.php">
                <span>Stack</span>
                <ion-icon name="logo-stackoverflow"></ion-icon>
            </a>
            <a href="./search.php" title="Busquedas">
                <ion-icon name="people-outline"></ion-icon>
            </a>
        </nav>
        <div class="list-users row row-cols-1 row-cols-md-4 px-1 mx-auto">
            <?php
                $id = $_REQUEST["Id"];
                if($id!="fd081b3aee0e3621f41190aa971cb9a5"){
                    require_once("../../../config/queries.php");
                    sql_Eliminar("delete from usuarios where token=:ID",$id);
                    ?> 
                        <div class="mt-5 mx-auto text-center" id="message-error-search">
                            <p>
                                <ion-icon name="happy-outline"></ion-icon>
                            </p>
                            <p>USUARIO ELIMINADO</p>
                        </div>
                    <?php
                }else{
                    ?>
                        <div class="mt-5 mx-auto text-center" id="message-error-search">
                            <p>
                                <ion-icon name="happy-outline"></ion-icon>
                            </p>
                            <p>ERROR USTED ES EL ADMINISTRADOR NO SERIA CONVENIENTE SER ELIMINADO</p>
                        </div>
                    <?php
                }
            ?>
        </div>
    </body>
    <!-- CDN Iconos -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>