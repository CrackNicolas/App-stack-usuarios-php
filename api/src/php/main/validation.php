<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximun-scale=1.0,minimum-scale=1.0">
        <link id="icon-favicon" rel="icon" href="../../../public/images/logo.png" type="image/png"/>
        <link rel="stylesheet" href="../../../public/styles/main.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <title>Login</title>
    </head>
    <body style="height: 100vh">
        <div class="form container p-4 mt-5">
            <div class="row">
                <div class="col-md-4 offset-md-4">    
                    <div class="card">
                        <div class="card-body">
                            <?php
                                $usuario = $_POST["Usuario"];
                                $password = $_POST["Password"];
                                session_start();
                                $_SESSION['usuario'] = $usuario;
                                if((strlen($password) && strlen($usuario)) == 0){
                                    ?> 
                                        <div class="message_error mb-3">
                                            <span>🙂 Todos los campos son requeridos</span>
                                        </div>
                                    <?php
                                }else{
                                    $band=true;
                                    require_once("../../validation/characters.php");
                                    if(ValidarUsers($usuario) && ValidarPass($password)){
                                        require_once("../../../config/queries.php");
                                        foreach(sql_Acceso($usuario,$password) as $i => $array){
                                            $_SESSION['tipo_de_usuario'] = $array['tipo_usuario'];
                                            $_SESSION['id_usuario'] = $array['id'];
                                            header("location:../menus/administrator.php");
                                            $band=false;
                                        }
                                        if($band){
                                            ?> 
                                                <div class="message_error mb-3">
                                                    <span>🤕 Se produjo un error de autenticacion</span>
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
                                    <ion-icon name="person-outline"></ion-icon>
                                    <p class="font-weight-bold text-primary">INICIAR SESIONs</p>
                                </label>
                                <div class="form-group">
                                    <input value="<?php echo $_POST["Usuario"]?>" type="text" name="Usuario" placeholder="Usuario..." class="w-100 p-2" maxlength="20">
                                </div>
                                <div class="form-group">
                                    <input value="<?php echo $_POST["Password"]?>" type="password" name="Password" placeholder="Password..." class="w-100 p-2" maxlength="20">
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="BotonAcceso" class="btn btn-success w-100">
                                        <ion-icon name="key-outline"></ion-icon>
                                        <span>Acceder</span>
                                    </button>
                                </div>
                                <a href="../../html/recovery.html">Olvide mi password</a>
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