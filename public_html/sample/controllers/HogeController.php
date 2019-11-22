<?php

class HogeController
{
    private $request;

    // コンストラクタ
    public function __construct()
    {
        // リクエスト
        $this->request = new Request();
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
}

?>
