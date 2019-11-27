<?php
/*
 リクエスト変数抽象クラス
 Post.php,QueryString.php,UrlParameter.phpの共通処理をまとめている
*/
abstract class RequestVariables
{
    protected $values;

    // コンストラクタ
    public function __construct()
    {
        $this->setValues();
    }

    // パラメータ値設定。protected＝このクラスと子クラスのみ参照可＝Request.phpやその他のクラスから値をセットすることは不可
    abstract protected function setValues();

    // 指定キーのパラメータを取得
    public function get($key = null)
    {
        $ret = null;
        //引数なしでget()が呼ばれたら$valuesをそのまま返す
        if (null == $key) {
            $ret = $this->values;
        } else {
            if (true == $this->has($key)) {
                $ret = $this->values[$key];
            }
        }
        return $ret;
    }

    // 指定のキーが存在するか確認
    public function has($key)
    {
        return array_key_exists($key, $this->values);
    }
}

?>
