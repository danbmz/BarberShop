<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// Ayuda a mostrar la suma total de servicios
function isLast(string $actual, string $next) : bool{
    if($actual !== $next){
        return true;
    }
    return false;
}

// Revisa que el usuario este autenticado
function isAuth() : void {
    if(!isset($_SESSION['login'])){
        header('Location: /login');    
    }
}