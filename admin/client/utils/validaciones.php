<?php

// SE NECESITA HACERLO BIEN ESTO ES UN ATAJO

function validaciones($campo, $direccion = "")
{
    if ($direccion == "") {
        return htmlspecialchars(trim(string: $_POST[$campo]));
    } else {
        if (!isset($_POST[$campo]) || trim($_POST[$campo]) === '') {
            header("Location: $direccion");
            exit;
        } 
        
        return htmlspecialchars($_POST[$campo]);
    }
}
