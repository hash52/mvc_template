<?php

class HogeController
{
    private $request;
    private $view;

    // コンストラクタ
    public function __construct()
    {
        // リクエスト
        $this->request = new Request();
        $this->view = new Smarty();
        $this->view->template_dir = '../views/templates';
        $this->view->compile_dir = '../views/templates_c';
    }

    public function helloAction()
    {
        $query = $this->request->getQuery();
        echo "Hello World!\n";
        foreach ($query as $key => $value) {
          echo $key.":".$value."\n";
        }
    }

    public function createAction()
    {
        $hoge = new Hoge();
        echo $hoge->create("hogehoge");
    }

    public function getAction(){
        $hoge = new Hoge();
        $hoges = $hoge->getHoge();
        foreach ($hoges as $key => $value) {
          echo $key.":".$value['text']."\n";
        }
    }

    public function viewAction()
    {
      // 文字列変数
       $this->view->assign("hello", "Hello");

       // 本当はDBからhogeさんを引っ張ってくる
       $this->view->assign("name", "hogeさん");

       // 配列も渡せるよ
       $data = array('log1','log2','log3','log4');
       $this->view->assign("logs", $data);
       $this->view->display('hogeview.html');
    }
}

?>
