<?php
/*
  各コントローラで必ず呼び出す処理を共通化する
  使用するテンプレートの指定も、コントローラやアクション名と命名規則で関連付けることでいちいち設定しないようにする
*/
abstract class ControllerBase
{
    protected $systemRoot;
    protected $controller = 'index';
    protected $action = 'index';
    protected $view;
    protected $request;
    protected $templatePath;

    // コンストラクタ
    public function __construct()
    {
        $this->request = new Request();
    }

    // システムのルートディレクトリパスを設定
    public function setSystemRoot($path)
    {
        $this->systemRoot = $path;
    }

    // コントローラーとアクションの文字列設定
    public function setControllerAction($controller, $action)
    {
        $this->controller = $controller;
        $this->action = $action;
    }

    // 処理実行
    public function run()
    {
        try {

            // ビューの初期化
            $this->initializeView();

            // 共通前処理（子クラスで定義される）
            $this->preAction();

            // アクションメソッド
            $methodName = sprintf('%sAction', $this->action);
            $this->$methodName();
            // 表示
            $this->view->display($this->templatePath);

        } catch (Exception $e) {
            // ログ出力等の処理を記述
        }
    }

    // ビューの初期化
    protected function initializeView()
    {
        $this->view = new Smarty();
        $this->view->template_dir = sprintf('%s/views/templates/', $this->systemRoot);
        $this->view->compile_dir = sprintf('%s/views/templates_c/', $this->systemRoot);
        //views/Controller名/action.html＝命名規則によるビューテンプレート指定の自動化
        $this->templatePath = sprintf('%s/%s.html', $this->controller, $this->action);
    }

    // 共通前処理（オーバーライド前提）
    protected function preAction()
    {
    }


    // リダイレクト
    public function redirect($url)
    {
        $redirectUrl = 'http://'.$_SERVER['HTTP_HOST'].'/'.$url;
        header('Location: ' . $redirectUrl);
        exit();
    }
}
?>
