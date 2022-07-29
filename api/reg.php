<?php
include_once "../base.php";

//存進資料表 user
//base.php有宣告$User
unset($_POST['pw2']);//清除pw2資料以符合資料表欄位
$User->save($_POST);//直接用$_POST
?>