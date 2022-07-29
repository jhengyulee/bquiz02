<?php
include_once "../base.php";
// ------------------------------------關於分頁與顯示/刪除發生的問題  不理解  多練習
foreach($_POST['id'] as $id){
    if(isset($_POST['del']) && in_array($id,$_POST['del'])){
        $News->del($id);
    }else{
        $row=$News->find($id);
        $row['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;
        $News->save($row);
    }
}

to("../back.php?do=news");
?>