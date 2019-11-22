<?php

class Hoge extends ModelBase
{
    protected $name = 'hoge';

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
