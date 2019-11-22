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
}

?>
