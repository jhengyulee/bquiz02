<!-- 最新文章區 -->
<fieldset>
    <legend>目前位置：首頁　> 最新文章區</legend>
    <table id="news">
        <tr>
            <td width="30%">標題</td>
            <td width="50%">內容</td>
            <td width="20%"></td>
        </tr>
        <!-- -------------------分頁 -->
        <?php
        $all=$News->math('count','id',['sh'=>1]);
        $div=5;
        $pages=ceil($all/$div);
        $now=$_GET['p']??1;    /** $_GET['p']從哪來 */
        $start=($now-1)*$div;

        $rows=$News->all(['sh'=>1]," limit $start,$div");

        foreach($rows as $row){

       
        ?>
        <tr>
            <td class="title clo"><?=$row['title'];?></td>
            <td><span class="summary"><?=mb_substr($row['text'],0,20);?>...</span> <!--內容從0開始取20字-->
                <span class="full" style="display:none"><?=nl2br($row['text']);?></span>
            </td>
            <td>
            
            <?php
               if(isset($_SESSION['user'])){
                if($Log->math('count','id',['news'=>$row['id'],'user'=>$_SESSION['user']])>0){
                    echo "- <a class='great' href='#' data-id='{$row['id']}'>收回讚</a>";
                }else{

                    echo "- <a class='great' href='#' data-id='{$row['id']}'>讚</a>";
                }
               
                }
               ?>
               </td>
        </tr>
        <?php
        }
        ?>
        
    </table>
    <div>
        <!-- 分頁字體大小變化 -->
        <?php

        //判斷是否有上一頁
        if(($now-1)>0){
            $p=$now-1; 
            echo "<a href='?do=news&p={$p}'> < </a>";
        }

        for($i=1;$i<=$pages;$i++){
            $fontsize=($now==$i)?'24px':'18px';
            echo "<a href='?do=news&p={$i}' style='font-size:{$fontsize}'> $i </a>";
        }


        //判斷是否有下一頁
        if(($now+1)<=$pages){
            $p=$now+1;
            echo "<a href='?do=news&p={$p}'> > </a>";
        }

        ?>
    </div>
</fieldset>

<script>
    $(".title").on("click",function(){
        $(this).next().children().toggle();
    })

    $(".great").on("click",function(){
        let type=$(this).text();
        let num=parseInt($(this).siblings('span').text());
        let id=$(this).data('id');
        if(type==='讚'){
            $(this).text('收回讚');
            $(this).siblings('span').text(num+1);
        }else{
            $(this).text('讚');
            $(this).siblings('span').text(num-1);
        }
            
    })

    
</script>