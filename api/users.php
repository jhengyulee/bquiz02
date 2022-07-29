<?php
include_once "../base.php";

$users=$User->all();
foreach($users as $user){
    
    if($user['acc']!=='admin'){ //若為管理者帳號  則不呈現

    
    echo"<tr>";
    echo"<td>{$user['acc']}</td>";
    echo"<td>".
        str_repeat('*',strlen($user['pw'])) .
        "</td>";
    echo"<td>";
    echo "<input type='checkbox' name='del[]' value='{$user['id']}'>";
    echo"</td>";
    echo"</tr>";
    }   
}

?>