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
}

?>
