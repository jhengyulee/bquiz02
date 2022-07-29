<!-- <h1>註冊頁面</h1> -->
<fieldset>
    <legend>會員註冊</legend>
    <div style="color: red;">*請設定您要註冊的帳號及密碼（最長12個字元）</div>
    <table>
        <tr>
            <td class="clo">Step1:登入帳號</td>
            <td><input type="text" name="acc" id="acc"></td>
        </tr>
        <tr>
            <td class="clo">Step2:登入密碼</td>
            <td><input type="password" name="pw" id="pw"></td>
        </tr>
        <tr>
            <td class="clo">Step3:再次確認密碼</td>
            <td><input type="password" name="pw2" id="pw2"></td>
        </tr>
        <tr>
            <td class="clo">Step4:信箱(忘記密碼時使用)</td>
            <td><input type="text" name="email" id="email"></td>
        </tr>
        <tr>
            <td><button onclick="reg()">註冊</button>
            <button onclick="reset()">清除</button>  <!--onclick沒作用-->
        </td>
            <td></td>
        </tr>
    </table>
</fieldset>

<script>
    //reset()
    function reset(){
        $('table input').val("");
    }

    //reg()
    function reg(){
    let user={
        acc:$('#acc').val(),
        pw:$('#pw').val(),
        pw2:$('#pw2').val(),
        email:$('#email').val()
    }

    if(user.acc=='' || user.pw=='' || user.pw2=='' || user.email==''){  //檢查空白
        alert('不可空白')
    }else if(user.pw != user.pw2){  //再次確認的密碼不符合
        alert('密碼錯誤')
    }else{
        $.get("./api/chk_acc.php",{acc:user.acc},(res)=>{  //用get傳值  取得資料用get傳值  改動資料用post傳值  冒號前為欄位 後為值
            if(parseInt(res)==1){  //1表有同樣帳號資料 重複註冊
                alert('帳號重複')
            }else{
                $.post('./api/reg.php',user,(res)=>{ //用post傳值
                    console.log(res);
                    alert("註冊完成，歡迎加入");
                    location.href="?do=login";

                }) 
            }     
        
        })   
    }
}





</script>


