<?php
/*
　dispatch・・(意)送る、送り出す、発送する
*/
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
        // 例: ttp://hoge.com/contr/act?id=5/ → contr/act?id=5
        $param = preg_replace('/^\//', '', $_SERVER['REQUEST_URI']);
        $param = preg_replace('/\/$/', '', $param);

        $params = array();
        if ('' != $param) {
            // 例: contr/act?id=5 → contr/act
            $param = explode('?',$param)[0];
            // パラメーターを / で分割。例: $params = ['contr','act']
            $params = explode('/', $param);
        }

        // $params[0]をコントローラー名として取得（$params[0]='contr'ならContrControllerをインスタンス化）
        $controller = null;
        if (0 < count($params)) {
            $controller = $params[0];
        }
        // 次の１行は発展的な内容であるので、初めて読むときは飛ばしてもいい(設定ファイルに基づいたルーティング処理)
        $controller = $this->transferControler($controller);
        // $controller = $params[0] = ttp://hoge.com/contr/actの "contr" をもとにコントローラークラスインスタンス取得
        // どうして"contr"からContrControllerのインスタンスが生成できるのかは、getControllerInstanceメソッドの実装を読むとわかる
        $controllerInstance = $this->getControllerInstance($controller);
        if (null == $controller) {
            //生成するコントローラが見つからなければ404を返して終了
            header("HTTP/1.0 404 Not Found");
            exit;
        }

        // $params[1]をアクション名として取得（$params[1]='act'actActionメソッドを実行)
        $action= "index";
        if (1 < count($params)) {
            $action = $params[1];
        }
        // アクションメソッドの存在確認
        // 例: ContrController.phpにactActionメソッドがあるかどうか確認している
        if (!method_exists($controllerInstance, $action . 'Action')) {
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
        // "."で文字列連結。一文字目のみ大文字に変換＋"Controller"
        $className = ucfirst(strtolower($controller)) . 'Controller';
        // ディレクトリとコントローラーファイル名の生成（例：$controllerFileName = /Users/HirokiHashi/workspace/php/mvc_template/public/sample/controllers/ContrController.php）
        $controllerFileName = sprintf('%s/controllers/%s.php', $this->sysRoot, $className);
        // ファイル存在チェック。なければ呼び出し元で404を返すため。
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
