<?php

require_once '/Users/HirokiHashi/workspace/php/mvc_template/library/mvc/Dispatcher.php';

$dispatcher = new Dispatcher();
$dispatcher->setSystemRoot('/Users/HirokiHashi/workspace/php/mvc_template/public_html/sample');
$dispatcher->dispatch();

?>
