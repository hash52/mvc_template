<?php
$mvc_library_path = '/Users/HirokiHashi/workspace/php/mvc_template/library/mvc/';
$public_sapmle_path = '/Users/HirokiHashi/workspace/php/mvc_template/public_html/sample/';

require_once $mvc_library_path.'Dispatcher.php';
require_once $mvc_library_path.'RequestVariables.php';
require_once $mvc_library_path.'Post.php';
require_once $mvc_library_path.'QueryString.php';
require_once $mvc_library_path.'Request.php';
require_once $mvc_library_path.'ControllerBase.php';
require_once $mvc_library_path.'ModelBase.php';
require_once $mvc_library_path.'Smarty/Smarty.class.php';

require_once $public_sapmle_path.'models/Hoge.php';

// DB接続情報設定
$connInfo = array(
    'host'     => 'localhost',
    'dbname'   => 'mvc_template',
    'charset'   => 'utf8mb4',
    'dbuser'   => 'root',
    'password' => 'root'
);
ModelBase::setConnectionInfo($connInfo );

$dispatcher = new Dispatcher();
$dispatcher->setSystemRoot('/Users/HirokiHashi/workspace/php/mvc_template/public_html/sample');
$dispatcher->dispatch();

?>
