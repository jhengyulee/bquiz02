<!-- <h1>忘記密碼</h1> -->

<fieldset>
    <legend>忘記密碼</legend>
    <div>請輸入信箱以查詢密碼</div>
    <div><input type="text" name="email" id="email"></div>
    <div id="result"></div>
    <div><button onclick="findPw()">尋找</button></div>
</fieldset>

<script>
    function findPw(){
        $.get("./api/find_pw.php",{email:$('#email').val()},(result)=>{  //ajax   7/29 9:30
            $("#result").html(result)
        })
    }
</script>
