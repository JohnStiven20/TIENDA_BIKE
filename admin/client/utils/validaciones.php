<?php

function validaciones($campo)
{
    return htmlspecialchars($_POST[$campo]);
}

?>