<?php


function errors_log($options=true){

echo ini_get('display_errors');

if (!ini_get('display_errors')) {
    ini_set('display_errors', $options);
}

echo ini_get('display_errors');

}

