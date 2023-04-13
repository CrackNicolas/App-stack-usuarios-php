<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link id="icon-favicon" rel="icon" href="../../../public/images/logo.png" type="image/png"/>
        <link rel="stylesheet" href="../../../public/styles/main.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <title>Recuperacion</title>
    </head>
    <body style="height: 100vh">
        <?php
            $email = $_POST['email'];
            $password = $_POST['pass'];
            $conFpassword = $_POST['confPass'];
        ?>
        <div class="form container p-4 mt-5">
            <div class="row">
                <div class="col-md-4 offset-md-4">    
                    <div class="card">
                        <div class="card-body">
                            <?php
                                if((strlen($conFpassword) && strlen($password) && strlen($email)) != 0){
                                    require_once("../../validation/characters.php");
                                    if(ValidarPass($password) && ValidarPass($conFpassword) && ValidarEmail($email)){
                                        if($conFpassword==$password){
                                            require_once("../../../config/connection.php");
                                            require_once("../../../config/queries.php");
                                            if(sql_Recuperacion($conexion,$email,$password)){
                                                ?> 
                                                    <div class="message_end mb-3">
                                                        <span>😁 Password recuperado</span>
                                                    </div>
                                                <?php
                                            }else{
                                                ?> 
                                                    <div class="message_error mb-3">
                                                        <span>😕 Email no encontrado</span>
                                                    </div>
                                                <?php
                                            }
                                        }else{
                                            ?> 
                                                <div class="message_error mb-3">
                                                    <span>😕 Error en la confirmacion del password</span>
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
                                }else{
                                    ?> 
                                        <div class="message_error mb-3">
                                            <span>🙂 Todos los campos son requeridos</span>
                                        </div>
                                    <?php
                                }
                            ?>
                            <form action="recover.php" method="POST">
                                <label class="header text-center border border-primary p-2 w-100 mb-3" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">
                                    <ion-icon name="bag-outline"></ion-icon>
                                    <p class="font-weight-bold text-primary">RECUPERAR PASSWORD</p>
                                </label>
                                <div class="form-group">
                                    <input value="<?php echo $email; ?>" type="email" name="email"  placeholder="Email..." class="w-100 p-2" maxlength="25">
                                </div>
                                <div class="form-group">
                                    <input value="<?php echo $password; ?>" type="password" name="pass"  placeholder="Nuevo password..." class="w-100 p-2" maxlength="20">
                                </div>
                                <div class="form-group">
                                    <input value="<?php echo $conFpassword; ?>" type="password" name="confPass"  placeholder="Confirmar password..." class="w-100 p-2" maxlength="20">
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="BotonNewUsuario" class="btn btn-success w-100">
                                        <ion-icon name="checkmark-circle-outline"></ion-icon>
                                        <span>Recuperar</span>
                                    </button>
                                </div>
                                <a id="Generar" href="generate_password.php">
                                    <span>Gererar password</span>
                                    <ion-icon name="key-outline"></ion-icon>
                                </a>
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