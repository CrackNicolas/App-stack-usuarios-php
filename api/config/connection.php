<?php
    try{
        $conexion = new PDO('mysql:host=bkq7wferkj4z65tnvxfm-mysql.services.clever-cloud.com;dbname=bkq7wferkj4z65tnvxfm',"ubp29saveadtvwhr","ubp29saveadtvwhr");
        $conexion -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);             //Sirve para Desactivar preparaciones emuladas
        $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);     //Esto evita que tenga que estar observando los resultados    
    }catch(Excepcion $e){
        ?>
            <h1 style="font-size:25px; border:1px solid red; border-radius:10px; padding:20px; text-align:center; color: red;">
                EL SERVIDOR NO SE ESTA EJECUTANDO NOTIFIQUE AL ADMINISTRADOR PARA SOLUCIONARLO
            <h1>
        <?php
    }
    //PDO::PARAM_STR Para variables string
    //PDO::PARAM_INT Para variables int
    //fetchAll() se usa solo cuando se trae muchos datos para el array
    //fetch() se usa solo para cuando se trae un solo dato
    //fetchColumn() se usa para verificar la cantidad de lineas afectas por tu consulta solo sirve con select y delete
    //execute() se usar par verificar si se realizo la accion de insert y update
?>