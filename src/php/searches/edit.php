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
        <?php
            $id = $_REQUEST["Id"];
            require_once("../../../config/queries.php");
            foreach(sql_Mostrar("select *from usuarios where token=:ID limit 1",$id) as $i => $array){
                ?>
                    <div class="form container p-4">
                        <div class="row pt-5 mt-4">
                            <div class="col-md-4 offset-md-4">    
                                <div class="card">
                                    <div class="card-body">
                                        <form action="execute.php" method="POST">
                                            <label class="header text-center border border-primary p-2 w-100 mb-3" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">
                                                <ion-icon name="create-outline"></ion-icon>
                                                <p class="font-weight-bold text-primary">ACTUALIZAR DATOS</p>
                                            </label>
                                            <div class="form-group">
                                                <input value="<?php echo $array["usuario"]; ?>" type="text" name="RegistrarUsuario" placeholder="Usuario..." class="w-100 p-2" maxlength="20">
                                            </div>
                                            <div class="form-group">
                                                <input value="<?php echo $array["email"]; ?>" type="email" name="Email"  placeholder="Email..." class="w-100 p-2" maxlength="25">
                                            </div>
                                            <div class="form-group">
                                                <input value="<?php echo $array["password"]; ?>" type="password" name="RegistrarPassword"  placeholder="Password..." class="w-100 p-2" maxlength="20">
                                            </div>
                                            <div class="form-group">
                                                <select name="TipoUsuario" class="custom-select" id="inputGroupSelect01">
                                                    <option><?php echo $array["tipo_usuario"]; ?></option>
                                                    <?php 
                                                        if($array["tipo_usuario"]!='Administrador'){ 
                                                            ?> <option>Administrador</option> <?php
                                                        }
                                                        if($array["tipo_usuario"]!='Usuario'){ 
                                                            ?> <option>Usuario</option> <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group mb-0">
                                                <input style="display:none;" type="text" name="ID" value="<?php echo $id; ?>"/>
                                                <button type="submit" name="BotonNewUsuario" class="btn btn-success w-100">
                                                    <ion-icon name="refresh-outline"></ion-icon>
                                                    <span>Actualizar</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php    
            }
        ?>
    </body>
    <!-- CDN Iconos -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>