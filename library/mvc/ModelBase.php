<?php

class ModelBase
{
    //static変数＝インスタンス間で共有する値
    private static $connInfo;
    protected $db;
    protected $name;

    public function __construct()
    {
        $this->initDb();
        // 継承先で$nameが設定されていない場合はクラス名からテーブル名を生成
        if ($this->name == null) {
            $this->setDefaultTableName();
        }
    }

    public function initDb()
    {
        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=%s',
            self::$connInfo['host'],
            self::$connInfo['port'],
            self::$connInfo['dbname'],
            self::$connInfo['charset']
        );
        $this->db = new PDO($dsn, self::$connInfo['dbuser'], self::$connInfo['password']);
    }

    public static function setConnectionInfo($connInfo)
    {
        self::$connInfo = $connInfo;
    }

    // クエリ結果を取得
    public function query($sql, array $params = null)
    {
        $stmt = $this->db->prepare($sql);
        if ($params != null) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
        }
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $rows;
    }

    // INSERTを実行
    public function insert($data)
    {

      // $dataを出力-----
      $error_log = "C:\MAMP\logs\php_error.log";
      // ----------------------

        $fields = array();
        $values = array();
        // $連想配列dataの'キー'を配列$fieldsに、':値'を配列$valuesに代入
        foreach ($data as $key => $val) {
            $fields[] = $key;
            $values[] = ':' . $key;
        }
        // 下記SQL文として$sqlに代入
        // $nameテーブルの$fieldsカラムを','区切りで文字列にしたものを、
        // $valuesを','区切りで文字列にしたものに挿入する
        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            $this->name,
            implode(',', $fields), //'title','body'
            implode(',', $values)  //':title',':body'
        );

        // $sqlも出力-----
        file_put_contents($error_log,'★★'.$sql."\n");
        // -----------------------------

        // prepareメソッドを用いて$stmtへSQL文をセット
        $stmt = $this->db->prepare($sql);
        // 引数の連想配列$dataのキー$key,値$valをbindValueメソッドを用いて
        // パラメータに値をセット
        foreach ($data as $key => $val) {
            $stmt->bindValue(':' . $key, $val);
        }
        // executeメソッドでクエリ実行
        $res  = $stmt->execute();
        return $res;
    }

    // DELETEを実行！未検証
    public function delete($where, $params = null)
    {
        $sql = sprintf("DELETE FROM %s", $this->name);
        if ($where != "") {
            $sql .= " WHERE " . $where;
        }
        $stmt = $this->db->prepare($sql);
        if ($params != null) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
        }
        $res = $stmt->execute();

        return $res;
    }

    //キャメルケースで命名されたクラス名からスネークケースのテーブル名を自動生成！動作未検証
    public function setDefaultTableName()
    {
        $className = get_class($this);
        $len = strlen($className);
        $tableName = '';
        for ($i = 0; $i < $len; $i++) {
            $char = substr($className, $i, 1);
            $lower = strtolower($char);
            if ($i > 0 && $char != $lower) {
                $tableName .= '_';
            }
            $tableName .= $lower;
        }
        $this->name  = $tableName;
    }
}

?>
