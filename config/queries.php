<?php
    function sql_Acceso($usuario,$password){
        require_once("connection.php");
        $acceso = $conexion->prepare("select id,tipo_usuario from usuarios where usuario=:Usuario and password=:Password");
        $acceso -> bindParam(":Usuario", $usuario, PDO::PARAM_STR);
        $acceso -> bindParam(":Password", $password, PDO::PARAM_STR);
        $acceso -> execute();
        return $acceso->fetchAll();
    }
    function sql_TraerToken($token){
        require_once("connection.php");
        $sentencia = $conexion->prepare("select token from where token = :token");
        $sentencia -> bindParam(":token",$token,PDO::PARAM_STR);
        $sentencia -> execute();
        return $sentencia->fetchAll();
    }
    function sql_Mostrar($instruccion,$id){
        include("connection.php");
        if($id==0){
            $mostrar = $conexion->prepare($instruccion);
        }else{
            $mostrar = $conexion->prepare($instruccion);
            $mostrar -> bindParam(":ID",$id,PDO::PARAM_INT);
        }  
        $mostrar -> execute();
        return $mostrar->fetchAll();
    }
    function sql_Registrar($conexion,$usuario,$password,$email,$TipoUsuario,$token){
        $existe = $conexion->prepare("select id from usuarios where usuario=:Usuario or email=:Email or password=:Password");
        $existe -> bindParam(":Email",$email,PDO::PARAM_STR);
        $existe -> bindParam(":Usuario",$usuario,PDO::PARAM_STR);
        $existe -> bindParam(":Password",$password,PDO::PARAM_STR);
        $existe -> execute();
        if(!$existe->fetchColumn()){
            $sentencia = $conexion->prepare("select usuarios.id from usuarios order by id");
            $sentencia->execute();    
            foreach($sentencia->fetchAll() as $i => $array){
                $pos = 1 + $array['id'];
            }
            $estado = $conexion->prepare("insert into usuarios value(:Pos,:Usuario,:Password,:Email,:tipoUsuario,:token)");
            $estado -> bindParam(":Pos",$pos,PDO::PARAM_INT);
            $estado -> bindParam(":Usuario",$usuario,PDO::PARAM_STR);
            $estado -> bindParam(":Password",$password,PDO::PARAM_STR);
            $estado -> bindParam(":Email",$email,PDO::PARAM_STR);
            $estado -> bindParam(":tipoUsuario",$TipoUsuario,PDO::PARAM_STR); 
            $estado -> bindParam(":token",$token,PDO::PARAM_STR); 
            $estado->execute();
            return true;
        }
        return false;
    }
    function sql_Buscar($Buscar){
        require_once("connection.php");
        $buscar = $conexion->prepare("select *from usuarios where id=:1 or usuario=:2 or password=:3 or email=:4 or tipo_usuario=:5 ");
        $buscar -> bindParam(":1",$Buscar,PDO::PARAM_INT);
        $buscar -> bindParam(":2",$Buscar,PDO::PARAM_STR);
        $buscar -> bindParam(":3",$Buscar,PDO::PARAM_STR);
        $buscar -> bindParam(":4",$Buscar,PDO::PARAM_STR);
        $buscar -> bindParam(":5",$Buscar,PDO::PARAM_STR); 
        $buscar -> execute();
        return $buscar->fetchAll();
    }
    function sql_Modificar($conexion,$id,$usuario,$password,$email,$TipoUsuario){
        $modificar = $conexion->prepare("update usuarios set usuario=:Usuario,password=:Password,email=:Email,tipo_usuario=:tipoDeUsuario where token=:ID");
        $modificar -> bindParam(":ID",$id,PDO::PARAM_INT);
        $modificar -> bindParam(":Usuario",$usuario,PDO::PARAM_STR);
        $modificar -> bindParam(":Password",$password,PDO::PARAM_STR);
        $modificar -> bindParam(":Email",$email,PDO::PARAM_STR);
        $modificar -> bindParam(":tipoDeUsuario",$TipoUsuario,PDO::PARAM_STR);
        return ($modificar->execute())? true : false;
    }  
    function sql_Recuperacion($conexion,$email,$password){
        $sentencia = $conexion->prepare("select id,email from usuarios where email=:Email");
        $sentencia -> bindParam(":Email",$email,PDO::PARAM_STR);
        $sentencia -> execute();
        if($sentencia->fetchColumn()){
            $modificar = $conexion->prepare("update usuarios set password=:Password where email=:Email");
            $modificar -> bindParam(":Password",$password,PDO::PARAM_STR);
            $modificar -> bindParam(":Email",$email,PDO::PARAM_STR);
            $modificar->execute();
            return true;
        }
        return false;
    }
    function sql_Eliminar($instruccion,$id){
        require_once("connection.php");
        if($id==0){
            $eliminar = $conexion->prepare($instruccion);
        }else{
            $sentencia = $conexion->prepare("select usuario,password from usuarios where token = :token");
            $sentencia -> bindParam(":token",$id,PDO::PARAM_STR);
            $sentencia -> execute();
            foreach($sentencia->fetchAll() as $i => $array){
                $compararToken = md5($array['usuario'].$array['password']."++"."perro");
                if($compararToken == $id){
                    $eliminar = $conexion->prepare($instruccion);
                    $eliminar -> bindParam(":ID", $id, PDO::PARAM_STR);
                }
            }   
        }
        $eliminar -> execute();
        return ($eliminar->execute())? true : false;
    }
    function sql_Preguntas($conexion,$contador){
        $preguntas = $conexion->prepare("select *from preguntas where id=:cont");
        $preguntas -> bindParam(":cont",$contador,PDO::PARAM_INT);
        $preguntas -> execute();
        return $preguntas->fetchAll();
    }
    function sql_Opciones($id){
        include("connection.php");
        $opciones = $conexion->prepare("select *from opciones where opcion=:ID");
        $opciones -> bindParam(":ID",$id,PDO::PARAM_INT);
        $opciones -> execute();
        return $opciones->fetchAll();
    }
    function sql_Buscar_revision($conexion,$usuario){
        $condicion = $conexion->prepare("select count(id) from preguntas");
        $condicion -> execute();
        $sentencia = $conexion->prepare("select count(id) from revision where id_usuario=:ID");
        $sentencia -> bindParam(":ID",$usuario,PDO::PARAM_STR);
        $sentencia -> execute();
        return ($sentencia->fetchColumn() == $condicion->fetchColumn())? true : false;
    }
    function sql_Registrar_Revision($conexion,$pregunta,$opcion,$valida,$usuario){
        $sentencia = $conexion->prepare("select id from revision where id_usuario=:Usuario and pregunta=:Pregunta");
        $sentencia -> bindParam(":Usuario",$usuario,PDO::PARAM_STR);
        $sentencia -> bindParam(":Pregunta",$pregunta,PDO::PARAM_STR);
        $sentencia -> execute();
        if(!$sentencia->fetchColumn()){
            $insert = $conexion->prepare("insert into revision value('',:preg,:opc,'$valida','$usuario')");
            $insert -> bindParam(":preg",$pregunta,PDO::PARAM_STR);
            $insert -> bindParam(":opc",$opcion,PDO::PARAM_INT);
            $insert -> execute();
        }
    }
    function sql_Id_Pregunta($conexion,$pregunta){
        $sentencia = $conexion->prepare("select id from preguntas where pregunta=:preg");
        $sentencia -> bindParam(":preg",$pregunta,PDO::PARAM_STR);
        $sentencia -> execute();
        foreach($sentencia->fetchAll() as $i => $array){
            $id = $array['id'];
        }
        return $id;
    }
    function sql_Identifica_Pregunta($conexion,$id,$opcion){
        $respuesta = $conexion->prepare("select *from opciones where opcion='$id' and descripcion=:opcion and validacion='True'");
        $respuesta -> bindParam(":opcion",$opcion,PDO::PARAM_INT);
        $respuesta -> execute();
        return ($respuesta->fetchColumn()>0)? true : false;
    }
    function sql_Nota($conexion,$usuario){
        $resultado = $conexion->prepare("select sum(validacion) from revision where validacion = 1 and id_usuario=:ID");
        $resultado -> bindParam(":ID",$usuario,PDO::PARAM_INT);
        $resultado -> execute();
        foreach($resultado->fetchAll() as $i => $array){
            $Nota = $array['sum(validacion)'];
        }
        return $Nota;
    }
    function sql_Respuesta_Pregunta($id){
        include("connection.php");
        $ResultadoFinal = $conexion->prepare("select descripcion from opciones where opcion='$id' and validacion='True' ");
        $ResultadoFinal -> execute();
        return $ResultadoFinal->fetchAll();
    }
    function sql_Resultados($estado,$conexion,$usuario,$nota){
        if($estado=="Inicio"){
            $sentencia = $conexion->prepare("select id from resultados where usuario=:Usuario");
            $sentencia -> bindParam(":Usuario",$usuario,PDO::PARAM_STR);
            $sentencia -> execute();
            if(!$sentencia->fetchColumn()){
                $insert = $conexion->prepare("insert into resultados value('',:Usuario,current_timestamp(),null,:Nota)");
                $insert -> bindParam(":Usuario",$usuario,PDO::PARAM_STR);
                $insert -> bindParam(":Nota",$nota,PDO::PARAM_INT);
                $insert -> execute();
            }
        }else{
            $sentencia = $conexion->prepare("select id from resultados where usuario=:Usuario and fecha_fin is null");
            $sentencia -> bindParam(":Usuario",$usuario,PDO::PARAM_STR);
            $sentencia -> execute();
            if($sentencia->fetchColumn()){
                $insert = $conexion->prepare("update resultados set fecha_fin=current_timestamp(), nota=:Nota where usuario=:Usuario");
                $insert -> bindParam(":Usuario",$usuario,PDO::PARAM_STR);
                $insert -> bindParam(":Nota",$nota,PDO::PARAM_INT);
                $insert -> execute();
            }
        }
    }
    function sql_View_resultados($conexion){
        require_once("connection.php");
        $sentencia = $conexion->prepare("select * from resultados");
        $sentencia -> execute();
        return $sentencia->fetchAll();
    }
    function sql_Traer_resultados($conexion,$usuario){
        require_once("connection.php");
        $sentencia = $conexion->prepare("select fecha_inicio,fecha_fin from resultados where usuario = :Usuario");
        $sentencia -> bindParam(":Usuario",$usuario,PDO::PARAM_STR);
        $sentencia -> execute();
        return $sentencia->fetchAll();
    }
    function Calcular_time_empleado($conexion,$usuario){
        require_once("connection.php");
        $sentencia = $conexion->prepare("select timediff(fecha_fin,fecha_inicio) tiempo from resultados where usuario = :Usuario");
        $sentencia -> bindParam(":Usuario",$usuario,PDO::PARAM_STR);
        $sentencia -> execute();
        return $sentencia->fetchAll();
    }
    function Calcular_time($conexion,$usuario,$fecha){
        $dia = array("domingo","lunes","martes","miercoles","jueves","viernes","sabado");
        $mes = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
        foreach(sql_Traer_resultados($conexion,$usuario) as $i => $array){
            $year = explode("-",explode(" ",$array[$fecha])[0])[0];
            $month = explode("-",explode(" ",$array[$fecha])[0])[1];
            $day = explode("-",explode(" ",$array[$fecha])[0])[2];
            $hour = explode(" ",$array[$fecha])[1];

            return $dia[$month-1]." ".$day." de ".$mes[$month-1]." de ".$year." a las ".$hour;
        }
    }
?>