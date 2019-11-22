<?php

class HogeController extends ControllerBase
{
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

    public function hogeviewAction()
    {
      // 文字列変数
       $this->view->assign("hello", "Hello");

       // 本当はDBからhogeさんを引っ張ってくる
       $this->view->assign("name", "hogeさん");

       // 配列も渡せるよ
       $data = array('log1','log2','log3','log4');
       $this->view->assign("logs", $data);
    }

    public function addAction()
    {
        $hoge = new Hoge();
        echo $hoge->add(['text'=>$this->request->getQuery()['text']]);
    }

    public function getbyidAction()
    {
        $hoge = new Hoge();
        $hoges = $hoge->getById($this->request->getQuery()['id']);
        foreach ($hoges as $key => $value) {
          echo 'id:'.$value['id']."/text:".$value['text']."\n";
        }
    }

    //http://localhost/hoge/threads/id_3 でid:3のhogeが取得できる
    public function threadsAction()
    {
        $id = 1;
        if (null != $this->request->getParam('id')) {
          $id = $this->request->getParam('id');
        }
        $hoge = new Hoge();
        $hoges = $hoges = $hoge->getById($id);
        foreach ($hoges as $key => $value) {
          echo 'id:'.$value['id']."/text:".$value['text']."\n";
        }
    }
}

?>
