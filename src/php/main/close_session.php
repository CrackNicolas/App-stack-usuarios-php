<?php
    session_start();
    session_unset(); //Libera todas las variables de sesion
    session_destroy(); //Destruye toda la informacion registrada de una sesion
    header("location:../../../index.html");
?>