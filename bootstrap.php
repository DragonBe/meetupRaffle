<?php

if (!defined('APPLICATION_PATH')) {
    define('APPLICATION_PATH', realpath('./'));
}
$paths = array (APPLICATION_PATH . '/src', get_include_path());
set_include_path(implode(PATH_SEPARATOR, $paths));
