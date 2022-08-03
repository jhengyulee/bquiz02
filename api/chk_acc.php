<?php
include_once "../base.php";
//檢查帳號是否存在
// $acc=$_POST['acc'];
// $chk=$User->find(['acc'=>$acc]);

$acc=$_POST['acc']??$_GET['acc']; //不是由post就是get取值
//直接count 產出1/0 判斷是否有acc
echo $User->math('count','id',['acc'=>$acc]); //['acc'=>$_POST['acc']]

?>