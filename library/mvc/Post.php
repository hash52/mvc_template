<?php

// POST変数クラス
class Post extends RequestVariables
{
    protected function setValues()
    {
        foreach ($_POST as $key => $value) {
            $this->values[$key] = $value;
        }
    }
}


?>
