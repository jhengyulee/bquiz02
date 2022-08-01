<?php

include_once "../base.php";


//2維陣列 宣告"健康新知"是1...
$array=[
    "健康新知"=>"1",
    "菸害防治"=>"2",
    "癌症防治"=>"3",
    "慢性病防治"=>"4"
];

$type=$array[$_GET['type']];

$rows=$News->all(['type'=>$type]);

foreach($rows as $row){
    echo"<a href='javascript:getNews({$row['id']})' style='display:block'>"; //這邊需特別理解
    echo $row['title'];
    echo"</a>";
}


?>