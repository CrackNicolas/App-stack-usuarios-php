<?php 
    function ValidarEmail($email){
        return (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-0_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z0-9_]{2,4}$/',$email))? true : false; 
    }
    function ValidarUsers($usuario){
        return preg_match('/^[a-zA-ZÑáñéíóúÁÉÍÓÚ ]+$/',$usuario)? true :  false;
    }
    function ValidarPass($password){
        return preg_match('/^[0-9a-zA-Z]+$/',$password)? true :  false;
    }
    function ValidarBuscador($Buscador){
        return preg_match('/^[0-9a-zA-Z ÑáñéíóúÁÉÍÓÚ]+$/',$Buscador)? true :  false;
    }
?>