<?php

spl_autoload_register(function ($class) {
    include
            $_SERVER['DOCUMENT_ROOT'] . '/Projet_eshop/class/' . $class . '.php';
});
