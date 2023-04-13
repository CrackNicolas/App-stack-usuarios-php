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
            <a href="../../html/administration.html" title="Busquedas">
                <ion-icon name="person-add-outline"></ion-icon>
            </a>
        </nav>
        <div class="search">
            <form action="validation.php" method="post">
                <button type="submit" value="" name="BotonBuscar">
                    <ion-icon name="search-outline"></ion-icon>
                </button>
                <input type="text" name="Buscar" value="<?php echo $_POST["Buscar"]?>" id="id" placeholder="Buscar...">
            </form>
        </div>
        <div class="list-users row row-cols-1 row-cols-md-4 px-1 mx-auto">
            <?php
                $band = true;
                $Buscar = $_POST["Buscar"];
                require_once("../../../config/queries.php");
                if(strlen($Buscar)==0){
                    $Array = sql_Mostrar("select *from usuarios",0);
                }else{
                    require_once("../../validation/characters.php");
                    if(ValidarBuscador($Buscar)){
                        $Array = sql_Buscar($Buscar);  
                        if(!$Array){
                            ?> 
                                <div class="mt-5 mx-auto text-center" id="message-error-search">
                                    <p>
                                        <ion-icon name="sad-outline"></ion-icon>
                                    </p>
                                    <p>NO SE ENCONTRARON RESULTADOS</p>
                                </div>
                            <?php
                        }
                    }else{
                        $band = false;
                        ?> 
                            <div class="mt-5 mx-auto text-center" id="message-error-search">
                                <p>
                                    <ion-icon name="sad-outline"></ion-icon>
                                </p>
                                <p>ERROR CARACTERES NO PERMITIDOS</p>
                            </div>
                        <?php
                    }                 
                }
                if($band){
                    foreach($Array as $i => $array){
                ?>
                    <div class="col mb-4">
                        <div class="card-user">
                            <div class="icons-card">
                                <a href="edit.php?Id=<?php echo $array['token']; ?>">
                                    <ion-icon name="create-outline"></ion-icon>
                                </a>
                                <a href="delete.php?Id=<?php echo $array['token']; ?>">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </a>
                            </div>
                            <div class="logo-users">
                                <ion-icon name="person-outline"></ion-icon>
                            </div>
                            <div class="description">
                                <div class="data">
                                    <div>
                                        <ion-icon name="key-outline"></ion-icon>
                                    </div>
                                    <div>
                                        <?php echo $array['id']; ?>   
                                    </div> 
                                </div>
                                <div class="data">
                                    <div>
                                        <ion-icon name="person-outline"></ion-icon>
                                    </div>
                                    <div>
                                        <?php echo $array['usuario']; ?>   
                                    </div> 
                                </div>
                                <div class="data">
                                    <div>
                                        <ion-icon name="bag-handle-outline"></ion-icon>
                                    </div>
                                    <div>
                                        <?php echo $array['password']; ?>   
                                    </div> 
                                </div>
                                <div class="data">
                                    <div>
                                        <ion-icon name="mail-outline"></ion-icon>
                                    </div>
                                    <div>
                                        <?php echo $array['email']; ?>   
                                    </div> 
                                </div>
                                <div class="data">
                                    <div>
                                        <ion-icon name="accessibility-outline"></ion-icon>
                                    </div>
                                    <div>
                                        <?php echo $array['tipo_usuario']; ?>   
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
            <?php }} ?>
        </div>
    </body>
    <!-- CDN Iconos -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>