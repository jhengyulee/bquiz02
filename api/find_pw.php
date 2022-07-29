<?php
include_once "../base.php";

$user=$User->find(['email'=>$_GET['email']]); //到資料庫找資料

if(!empty($user)){
    echo "您的密碼為:".$user['pw'];
}else{
    echo "查無此資料";
}

//三元運算式
// echo (!empty($user))?"您的密碼為:".$user['pw']:"查無此資料";

?>
