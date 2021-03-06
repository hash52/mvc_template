<?php
/*（備考）
　この解説は、複雑な完成品を上から解説しようという試み
　もしかすると、コミットを遡って古い順にコードを追った方がシンプルで流れが追いやすいかもしれない・・
*/

/*
　本来、URLとは要求するファイルのディレクトリ階層を表すものであるが、
　ここでは、.htaccessの設定により全てのURLがこのindex.phpに集まる。
　.htaccessとはApacheの設定ファイルであるが、詳細についてはここでは省略。
　気になる人は「url rewrite apache」でググってみましょう
*/
$mvc_template_path = '/your_path/mvc_template/';
$mvc_library_path = $mvc_template_path.'library/mvc/';
$public_path = $mvc_template_path.'/public/';
$app_name = 'sample';

//必要な外部phpファイルの読み込みは全てここで行っている。
require_once $mvc_library_path.'Dispatcher.php';
require_once $mvc_library_path.'RequestVariables.php';
require_once $mvc_library_path.'Post.php';
require_once $mvc_library_path.'QueryString.php';
require_once $mvc_library_path.'Request.php';
require_once $mvc_library_path.'ControllerBase.php';
require_once $mvc_library_path.'ModelBase.php';
require_once $mvc_library_path.'UrlParameter.php';
require_once $mvc_library_path.'Smarty/Smarty.class.php';

require_once $public_path.$app_name.'/models/Hoge.php';

// DB接続情報設定
$connInfo = array(
    'host'     => 'localhost',
    'dbname'   => 'mvc_template',
    'port' => '8889',
    'charset'   => 'utf8mb4',
    'dbuser'   => 'root',
    'password' => 'root'
);
//ModelBaseの$connInfoはstaticであるので、インスタンスを超えて共有される値
ModelBase::setConnectionInfo($connInfo );

$dispatcher = new Dispatcher();
$dispatcher->setSystemRoot($public_path.$app_name);
//全ての処理の起点、Dispatcherクラスのdispatchメソッドへ
$dispatcher->dispatch();

?>
