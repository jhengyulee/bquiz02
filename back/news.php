<form action="./api/news.php" method="post">
<table style=" width:80%;margin:auto;text-align:center">
    <tr>
        <th width="10%">編號</th>
        <th width="70%">標題</th>
        <th width="10%">顯示</th>
        <th width="10%">刪除</th>
    </tr>
    <?php
    // -------------------------------------------- 分頁  7/29 pm 0130
    $all=$News->math('count','id');
    $div=3; //
    $pages=ceil($all/$div);//無條件進位
    $now=$_GET['p']??1; /** $_GET['p']從哪來 */
    $start=($now-1)*$div;
    $rows=$News->all(" limit $start ,$div");
    // -------------------------------------------
    foreach($rows as $key => $row){
    
    ?>
    <tr>
        <td><?=$now*$div-2+$key;?></td>  <!--題目編號會跟隨分頁變動-->
        <td><?=$row['title'];?></td>
        <td><input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=($row['sh']==1)?'checked':'';?>></td>
        <td><input type="checkbox" name="del[]" value="<?=$row['id'];?>"></td>
        <input type="hidden" name="id[]" value="<?=$row['id'];?>">
    </tr>
    <?php
    }
    ?>

</table>
<!-- --------------------當前頁數呈現 ------------------>
<div class="ct">
    <?php
    if(($now-1)>0){
        echo "<a href='?do=news&p=".($now-1)."'> < </a>";
    }

    for($i=1;$i<=$pages; $i++){
        $fontsize=($now==$i)?'24px':'16px';
        echo "<a href='?do=news&p={$i}' style='font-size:$fontsize'>";
        echo $i;
        echo "</a>";
    }
    if(($now+1)<=$pages){
        echo "<a href='?do=news&p=".($now+1)."'> > </a>";
    }

    ?>
</div>
<!-- -------------------------------------------- -->
<div class="ct"><input type="submit" value="確定修改"></div>
</form>


