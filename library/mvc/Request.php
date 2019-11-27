<?php
/*
 PHPではGET,POSTパラメータを取得するために$_GET,$_POSTがスーパーグローバル(全てのスコープで使用可能な)変数として用意されているが、
 これはただの変数であるため再代入可能であり、本来サーバ側からは変更不可であるはずのユーザリクエストの性質とは矛盾している。
 パラメータ取得時に$_GET(POST)をそのまま使用したとして、もし不慣れなプログラマが不用意に値を再代入してしまえば、バグの原因になってしまう。
 そういったことを防ぐために、クラス化して取得のみできるような形にし、決まりごととしてグローバル変数は直接参照しないというルールを作る。（オブジェクト指向のカプセル化）
*/
class Request
{
    // POSTパラメータ
    private $post;
    // GETパラメータ
    private $query;
    // URLパラメータ
    private $param;

    // コンストラクタ@
    public function __construct()
    {
        $this->post = new Post();
        $this->query = new QueryString();
        $this->param = new UrlParameter();
    }

    // POST変数取得
    public function getPost($key = null)
    {
        if (null == $key) {
            return $this->post->get();
        }
        if (false == $this->post->has($key)) {
            return null;
        }
        return $this->post->get($key);
    }

    // GET変数取得
    public function getQuery($key = null)
    {
        if (null == $key) {
            return $this->query->get();
        }
        if (false == $this->query->has($key)) {
            return null;
        }
        return $this->query->get($key);
    }

    // URLパラメーター取得
    public function getParam($key = null)
    {
        if (null == $key) {
            return $this->param->get();
        }
        if (false == $this->param->has($key)) {
            return null;
        }
        return $this->param->get($key);
    }
}

?>
