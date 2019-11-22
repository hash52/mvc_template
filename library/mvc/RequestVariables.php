<?php

// リクエスト変数抽象クラス
abstract class RequestVariables
{
    protected $values;

    // コンストラクタ
    public function __construct()
    {
        $this->setValues();
    }

    // パラメータ値設定
    abstract protected function setValues();

    // 指定キーのパラメータを取得
    public function get($key = null)
    {
        $ret = null;
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
        if (false == array_key_exists($key, $this->values)) {
            return false;
        }
        return true;
    }
}

?>
