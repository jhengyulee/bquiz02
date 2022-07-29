<!-- 文壓圖<fieldset> <legend> -->
<fieldset>
    <legend>會員登入</legend>

    <table>
        <tr>
            <td class="clo">帳號</td>
            <td>
                <input type="text" id="acc" name="acc">
            </td>
        </tr>
        <tr>
            <td class="clo">密碼</td>
            <td>
                <input type="password" name="pw" id="pw">
            </td>
        </tr>
        <tr>
            <td>
                <button onclick="login()">登入</button>
                <button onclick="$('#acc,#pw').val('')">清除</button>
            </td>
            <td class="r">
                <a href="?do=forgot">忘記密碼</a>
                <a href="?do=reg">尚未註冊</a>
            </td>
        </tr>
    </table>
</fieldset>

<!-- ----------------------------------------7/28 pm 0315 巢狀超過5層  多練習理解  搭配 chk_acc.php/chk_pw.php --> 
<!-- 放在以上的DOM後面執行 -->
<script>
function login(){
    let acc=$('#acc').val(); //acc來自id=acc傳來的值
    let pw=$('#pw').val();
    $.post("./api/chk_acc.php",{acc},(res)=>{ //post方式傳值 {acc:$('#acc').val()}
        console.log('acc',res);
        if(parseInt(res)===1){
            $.post("./api/chk_pw.php",{acc,pw},(res)=>{
            console.log('pw',res);
            if(parseInt(res)===1){
                if(acc==='admin'){
                    location.href='back.php';
                }else{
                    location.href='index.php'
                }
            }else{
                alert('密碼錯誤')
            }
            })

        }else{
            alert('查無此帳號');
        }
    })
}

</script>