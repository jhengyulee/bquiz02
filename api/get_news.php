<?php

include_once "../base.php";


//8/1 am 10:35  ------------------------回播

$id=$_GET['id'];  

$news=$News->find($id);

echo nl2br($news['text']); //nl:斷行 2:to br 




?>