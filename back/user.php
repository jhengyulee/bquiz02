<!-- <h1 class="ct">帳號管理</h1> -->
<fieldset>
    <legend>帳號管理</legend>
    <table>
        <tr>
            <td class="clo">密碼</td>
            <td class="clo">帳號</td>
            <td class="clo">刪除</td>
        </tr>
       <tbody id="users">

       </tbody>
    </table>
    <div class="ct">
        <button onclick="del()">確定刪除</button>
        <button onclick="$('table input').prop('checked',false)">清空選取</button>  <!--checkbox的值的選擇跟input不同 要用prop給予false的方式-->
    </div>



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

    getUsers();



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
                    // console.log(res);
                    getUsers();
                    

                }) 
            }     
        
        })   
    }
}



    function getUsers(){

        $.get("./api/users.php",(users)=>{     //ajax 畫面不會閃動
            $('#users').html(users)
        })
    }

// ---------------------------------------------------------------這裡很特別  注意-------------------
    function del(){   //利用屬性選擇器選擇被勾選的項目
        
        let ids=new Array();  //new ->表宣告一個物件
        
        $("table input[type='checkbox']:checked").each((idx,box)=>{   //屬性選擇器[type='checkbox']:checked
            ids.push($(box).val()); //push()表放東西進去 (box) 為each取出的值--------------------??????????
        })
        // console.log(ids);
        $.post("./api/del_user.php",{del:ids},(res)=>{   //將del:ids這個陣列傳到api 接著到api進行動作
            // console.log(res);
            getUsers(); //從api回來後重新顯示users的畫面
        })
    }


   


</script>