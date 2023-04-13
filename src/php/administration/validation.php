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
    <body style="height: 100vh">
        <nav class="menu-administrator">
            <a href="../menus/administrator.php">
                <span>Stack</span>
                <ion-icon name="logo-stackoverflow"></ion-icon>
            </a>
            <a href="../searches/search.php" title="Busquedas">
                <ion-icon name="people-outline"></ion-icon>
            </a>
        </nav>
        <?php
            $usuario = $_POST["RegistrarUsuario"];
            $password = $_POST["RegistrarPassword"];
            $email = $_POST["Email"];
            $token = md5($usuario.$password."++"."perro");
            $TipoUsuario = isset($_POST["TipoUsuario"])? $_POST["TipoUsuario"] : "Seleccione el tipo de usuario..."
        ?>
        <div class="form container p-4">
            <div class="row pt-5 mt-4">
                <div class="col-md-4 offset-md-4">    
                    <div class="card">
                        <div class="card-body">
                            <?php
                                if((strlen($usuario) && strlen($password) && strlen($email)) == 0){
                                    ?> 
                                        <div class="message_error mb-3">
                                            <span>🙂 Todos los campos son requeridos</span>
                                        </div> 
                                    <?php
                                }else if($TipoUsuario=="Seleccione el tipo de usuario..."){
                                    ?> 
                                        <div class="message_error mb-3">
                                            <span>🙂 El tipo de usuario es requerido</span>
                                        </div> 
                                    <?php
                                }else{
                                    require_once("../../validation/characters.php");
                                    if(ValidarUsers($usuario) && ValidarPass($password) && ValidarEmail($email)){
                                        require_once("../../../config/connection.php");
                                        require_once("../../../config/queries.php");
                                        if(sql_Registrar($conexion,$usuario,$password,$email,$TipoUsuario,$token)){
                                            ?> 
                                                <div class="message_end mb-3">
                                                    <span>😎 Usuario registrado con exito</span>
                                                </div> 
                                            <?php
                                        }else{
                                            ?> 
                                                <div class="message_error mb-3">
                                                    <span>🤕 Error los datos del usuario ya existen</span>
                                                </div> 
                                            <?php
                                        }
                                    }else{
                                        ?> 
                                            <div class="message_error mb-3">
                                                <span>😕 Error caracteres no permitidos</span>
                                            </div> 
                                        <?php
                                    }
                                }
                            ?>
                            <form action="validation.php" method="POST">
                                <label class="header text-center border border-primary p-2 w-100 mb-3" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">
                                    <ion-icon name="person-add-outline"></ion-icon>
                                    <p class="font-weight-bold text-primary">REGISTRAR USUARIOS</p>
                                </label>
                                <div class="form-group">
                                    <input value="<?php echo $usuario; ?>" type="text" name="RegistrarUsuario" placeholder="Usuario..." class="w-100 p-2" maxlength="20">
                                </div>
                                <div class="form-group">
                                    <input value="<?php echo $email; ?>" type="email" name="Email"  placeholder="Email..." class="w-100 p-2" maxlength="25">
                                </div>
                                <div class="form-group">
                                    <input value="<?php echo $password; ?>" type="password" name="RegistrarPassword"  placeholder="Password..." class="w-100 p-2" maxlength="20">
                                </div>
                                <div class="form-group">
                                    <select name="TipoUsuario" class="custom-select" id="inputGroupSelect01">
                                        <option><?php echo $TipoUsuario; ?></option>
                                        <?php 
                                            if($TipoUsuario!='Administrador'){ 
                                                ?> <option>Administrador</option> <?php
                                            }
                                            if($TipoUsuario!='Usuario'){ 
                                                ?> <option>Usuario</option> <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" name="BotonNewUsuario" class="btn btn-success w-100">
                                        <ion-icon name="add-circle-outline"></ion-icon>
                                        <span>Registrar</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <!-- CDN Iconos -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>