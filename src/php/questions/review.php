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
        <?php
            require_once("../../../config/connection.php");
            require_once("../../../config/queries.php");
            session_start();
            $id = $_SESSION['id_usuario'];
            if(!sql_Buscar_revision($conexion,$id)){
                $opcion = (!isset($_POST['opc']))? "" : $_POST['opc'];
                $pregunta = $_POST['pregunta'];
                sql_Registrar_Revision($conexion,$pregunta,$opcion,(sql_Identifica_Pregunta($conexion,sql_Id_Pregunta($conexion,$pregunta),$opcion))? True: False,$id);
            }    
            $usuario = $_SESSION['usuario'];
            $Nota = sql_Nota($conexion,$id); 
            sql_Resultados("Fin",$conexion,$usuario,$Nota);
            ?>
                <div class="row row-cols-1 row-cols-md-1 pt-5 px-2 mx-auto">
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-text">Nombre de usuario <?php echo $_SESSION['usuario'] ?> </h5>
                            <h5 class="card-text">Comenzado el
                                <?php
                                    echo Calcular_time($conexion,$usuario,"fecha_inicio");
                                ?>
                            </h5>
                            <h5 class="card-text">Estado finalizado</h5>
                            <h5 class="card-text">Finalizado en
                                <?php
                                    echo Calcular_time($conexion,$usuario,"fecha_fin");
                                ?>   
                            </h5>
                            <h5 class="card-text">Tiempo empleado 
                                <?php 
                                    foreach(Calcular_time_empleado($conexion,$usuario) as $i => $array){
                                        $hour = (int) explode(":",$array["tiempo"])[0];
                                        $minutes = (int) explode(":",$array["tiempo"])[1];
                                        $seconds = (int) explode(":",$array["tiempo"])[2];
                                        echo 
                                            (($hour > 0)? $hour." hs y ":"" ).
                                            (($minutes > 0)? $minutes." min ":"").
                                            (($seconds > 0)? $seconds." seg":"");
                                    }
                                ?> 
                            </h5>
                            <?php 
                                if($Nota!=0){
                                    ?>
                                        <h5 class="card-text">
                                            Calificacion <?php echo $Nota;?> de 10,00 (<?php echo ($Nota/10)*100; ?>%) 
                                        </h5>
                                    <?php
                                }else{
                                    ?>
                                        <h5 class="card-text">
                                            Calificacion <?php echo "0";?> de 10,00 (<?php echo ($Nota/10)*100; ?>%) 
                                        </h5>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
        ?>
        <div class="questions row row-cols-1 row-cols-md-1 pt-3 px-2 pb-3 mx-auto">
            <?php  
                foreach(sql_Mostrar("select *from revision where id_usuario=:ID",$id) as $i => $array1){
            ?>
                <div class="card mt-2">
                    <div class="card-body">
                        <h4 class="card-title font-bold">Pregunta <?php echo $i+1; ?> </h4>
                        <h6 class="info text-secondary">
                            <?php echo ($array1['validacion'])? "Correcta":"Incorrecta"; ?>
                            Puntua como
                            <?php 
                                echo ($array1['validacion'])? "1" : "0";
                                $correcta = $array1['validacion'];
                            ?> 
                            sobre 1
                        </h6>
                        <form action="execute.php" method="post">
                            <p class="question card-text">
                                <?php 
                                    echo $array1['pregunta']; 
                                    $preg = $array1['pregunta'];
                                ?>
                            </p>
                            <p class="card-title mb-1">Seleccione una:</p>
                            <?php
                                foreach(sql_Opciones(sql_Id_Pregunta($conexion,$preg)) as $i => $array3){
                                ?>
                                    <label class="options card-text"> 
                                        <input type="radio" name="opc" value="<?php echo $array3['descripcion']; ?>" <?php if($array3['descripcion']==$array1['opcion']) echo "checked"; ?> disabled>
                                        <span>
                                            <?php 
                                                echo $array3['descripcion']; 
                                                if($array3['descripcion']==$array1['opcion']){
                                                    if($correcta){
                                                        ?> <i style="color:rgb(0, 250, 33)" class="fas fa-check-circle"></i> <?php
                                                    }else{
                                                        ?> <i style="color:red" class="fas fa-exclamation-circle"></i> <?php
                                                    }
                                                }    
                                            ?>  
                                        </span>
                                    </label>
                            <?php } ?>
                        </form>
                        <?php
                            foreach(sql_Respuesta_Pregunta(sql_Id_Pregunta($conexion,$preg)) as $i => $array4){
                                ?>
                                    <div class="response card-text mt-3 text-primary">
                                        <span>
                                            Respuesta correcta: <?php echo $array4['descripcion']; ?>
                                        </span>
                                    </div>
                                <?php 
                            }
                        ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </body>
    <!-- CDN Iconos -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/12d22a04ab.js" crossorigin="anonymous"></script>
</html>