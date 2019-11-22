<?php

class Hoge
{
    private $db;
    private $name = 'hoge';

    public function __construct()
    {
      $db_perm = array(
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      );
        $this->db = new PDO('mysql:host='.'localhost'.'; dbname='.'mvc_template'.'; charset='.'utf8mb4' , 'root', 'root', $db_perm);
    }

    // カート基本情報取得
    public function getHoge()
    {
        $sql = sprintf('SELECT * FROM %s' , $this->name);
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    // 新規カート作成
    public function create($text)
    {
        $sql = sprintf('INSERT INTO %s (id, text) VALUES(null , :text)', $this->name);
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':text', $text);
        $res = $stmt->execute();
        return $res;
    }

}

?>
