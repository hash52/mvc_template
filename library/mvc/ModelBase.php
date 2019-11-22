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
    }

    public function initDb()
    {
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            self::$connInfo['host'],
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
        $fields = array();
        $values = array();
        foreach ($data as $key => $val) {
            $fields[] = $key;
            $values[] = ':' . $val;
        }
        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            $this->name,
            implode(',', $fields),
            implode(',', $values)
        );
        $stmt = $this->db->prepare($sql);
        foreach ($data as $key => $val) {
            $stmt->bindValue(':' . $val, $val);
        }
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
}

?>
