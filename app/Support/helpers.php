<?php
if(!function_exists('isActive')){
    function isActive($active,$tab) {

        return $active == $tab ? 'active' : '';
    }
}
if(!function_exists('isActiveShow')){
    function isActiveShow($active,$tab) {

        return $active == $tab ? 'show active' : '';
    }
}

if(!function_exists('isActiveTrue')){
    function isActiveTrue($active,$tab) {

        return $active == $tab ? 'true' : 'false';
    }
}

