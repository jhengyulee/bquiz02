<?php
include_once "../base.php";
//檢查帳號是否存在
// $acc=$_POST['acc'];
// $chk=$User->find(['acc'=>$acc]);

//直接count 產出1/0 判斷是否有acc + pw
$chk= $User->math('count','id',['acc'=>$_POST['acc'],'pw'=>$_POST['pw']]); //

if($chk){
    $_SESSION['user']=$_POST['acc'];
    echo 1;
}else{
    echo 0;
}
?>