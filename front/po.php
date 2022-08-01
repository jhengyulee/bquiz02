<!-- 分類網誌 -->

<style>
    .type{
        cursor:pointer;
        color: blue;
        margin: 1rem 0;
        max-width: max-content; /*最大寬度=最大內容*/ 
    }

    .type:hover{
        border-bottom:1px solid blue;
    }
</style>


<div>目前位置：首頁 > 分類網誌 > <span id="header">健康新知</span></div>
<div style="display:flex"> <!--直接賦予flex屬性-->
<fieldset >
    <legend>分類網誌</legend>
    <div class="type">健康新知</div>
    <div class="type">菸害防治</div>
    <div class="type">癌症防治</div>
    <div class="type">慢性病防治</div>
</fieldset>
<fieldset>
    <legend>文章列表</legend>
    <div id="content"></div>
</fieldset>
</div>

<!-- 從後端撈資料呈現在網頁上!!  -->
<script>

    getList('健康新知');

    $('.type').on("click",function(){
        let type=$(this).text();  //$(this) 代表點下去的那顆按鈕
        $('#header').text(type);
        getList(type);//從後台撈回資料
    })
// ---------------------------------------------------  8/1 am 10:15  搞懂~~~~
    function getList(type){
        $.get("./api/get_list.php",{type},(list)=>{
            $('#content').html(list);
        })
    }
// ------------------------------------------------------

//-------------------------------------------------------
function getNews(id){
    $.get("./api/get_news.php",{id},(news)=>{
        $("#content").html(news)
    })
}

//-------------------------------------------------------
</script>