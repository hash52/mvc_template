<?php

class Dispatcher
{
    private $sysRoot;

    public function setSystemRoot($path)
    {
        $this->sysRoot = rtrim($path, '/');
    }

    public function dispatch()
    {
        // パラメーター取得（行頭末尾の / は削除）
        $param = preg_replace('/^\//', '', $_SERVER['REQUEST_URI']);
        $param = preg_replace('/\/$/', '', $param);

        $params = array();
        if ('' != $param) {
            $param = explode('?',$param)[0];
            // パラメーターを / で分割
            $params = explode('/', $param);
        }


        // １番目のパラメーターをコントローラーとして取得
        $controller = null;
        if (0 < count($params)) {
            $controller = $params[0];
        }
        $controller = $this->transferControler($controller);
        // １番目のパラメーターをもとにコントローラークラスインスタンス取得
        $controllerInstance = $this->getControllerInstance($controller);
        if (null == $controller) {
            header("HTTP/1.0 404 Not Found");
            exit;
        }

        // 2番目のパラメーターをアクションとして取得
        $action= "index";
        if (1 < count($params)) {
            $action = $params[1];
        }
        // アクションメソッドの存在確認
        if (false == method_exists($controllerInstance, $action . 'Action')) {
            header("HTTP/1.0 404 Not Found");
            exit;
        }

        // コントローラー初期設定
        $controllerInstance->setSystemRoot($this->sysRoot);
        $controllerInstance->setControllerAction($controller, $action);
        // 処理実行
        $controllerInstance->run();
    }

    // コントローラークラスのインスタンスを取得
    private function getControllerInstance($controller)
    {
        // 一文字目のみ大文字に変換＋"Controller"
        $className = ucfirst(strtolower($controller)) . 'Controller';
        // コントローラーファイル名
        $controllerFileName = sprintf('%s/controllers/%s.php', $this->sysRoot, $className);
        // ファイル存在チェック
        if (false == file_exists($controllerFileName)) {
            return null;
        }
        // クラスファイルを読込
        require_once $controllerFileName;
        // クラスが定義されているかチェック
        if (false == class_exists($className)) {
            return null;
        }
        // クラスインスタンス生成
        $controllerInstarnce = new $className();

        return $controllerInstarnce;
    }

    //URLのコントローラ部がtransfer.iniのキーに一致すれば、実際の遷移先をiniで定義したコントローラに変更する
    //例：basic/get → HogeController@get
    private function transferControler($controller)
    {
        $iniPath = $this->sysRoot . '/ini/transfer.ini';
        if (file_exists($iniPath)) {
            $ini = parse_ini_file($iniPath);
            if (array_key_exists($controller, $ini)) {
                $controller = $ini[$controller];
            }
        }
        return $controller;
    }
}

?>
