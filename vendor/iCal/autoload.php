<?php
function custom_autoloader($class) {
    include 'iCal/' . $class . '.php';
}

spl_autoload_register('Example');

$objFooBar = new FooBar();
?>
