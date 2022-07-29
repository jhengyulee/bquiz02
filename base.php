<?php

session_start();
date_default_timezone_set('Asia/Taipei');


class DB
{

    protected $table;
    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=db24_2";
    protected $pdo;


    function __construct($table)
    {
        //$this表產出的結果  
        $this->table = $table;
        $this->pdo = new PDO($this->dsn, 'root', '', []);
    }

    //1.新增資料 insert()
    //2.修改資料 update()
    //  1.2.整合成 save()

    //3.查詢資料 all();find() 
    //4.刪除資料 del()
    //5.計算 max(),min(),sum(),count(),avg() 整合成 math()


    //all()
    function all(...$arg)
    {
        $sql = "SELECT * FROM $this->table ";
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                foreach ($arg[0] as $key => $val) {
                    $tmp[] = "`$key`='$val'";
                }
                $sql .= " WHERE " . join(" AND ", $tmp);
            } else {
                $sql .= $arg[0]; //可能是非欄位條件的其他條件 eg.order by...

            }
        }

        if (isset($arg[1])) {
            $sql .= $arg[1];
        }

        // return $sql;
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    // all() end

    //find() 只抓一筆
    function find($id)
    {
        $sql = "SELECT * FROM $this->table WHERE ";

        if (is_array($id)) {
            foreach ($id as $key => $val) {
                $tmp[] = "`$key`='$val'";
            }
            $sql .= join(" AND ", $tmp);
        } else {
            $sql .= "`id` = '$id'"; //

        }


        // return $sql;備用
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    //find() end


    //del()
    function del($id)
    {
        $sql = "DELETE FROM $this->table WHERE ";

        if (is_array($id)) {
            foreach ($id as $key => $val) {
                $tmp[] = "`$key`='$val'";
            }
            $sql .= join(" AND ", $tmp);
        } else {
            $sql .= "`id` = '$id'";
        }




        // return $sql;備用
        return $this->pdo->exec($sql);
    }

    //del() end

    //math()
    function math($math, $col, ...$arg)
    {
        $sql = "SELECT $math($col) FROM $this->table ";
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                foreach ($arg[0] as $key => $val) {
                    $tmp[] = "`$key`='$val'";
                }
                $sql .= " WHERE " . join(" AND ", $tmp);
            } else {
                $sql .= $arg[0]; //可能是非欄位條件的其他條件 eg.order by...

            }
        }

        if (isset($arg[1])) {
            $sql .= $arg[1];
        }

        // return $sql;備用
        return $this->pdo->query($sql)->fetchColumn(); //為何這邊不用PDO::FETCH_ASSOC
    }


    //math() end

    //save()
    function save($array)
    {


        if (isset($array['id'])) {
            //更新
            foreach ($array as $key => $val) {
                $tmp[] = "`$key`='$val'";
            }

            $sql = "UPDATE $this->table SET " . join(',', $tmp) . " WHERE `id`= '{$array['id']}'";
        } else {
            //新增   單雙上引號易出錯  務必注意------------------------------------------------------
            $sql = "INSERT INTO $this->table (`" . join("`,`", array_keys($array)) . "`) 
                                    VALUES ('" . join("','", $array) . "')";
        }


        // echo $sql;
        return $this->pdo->exec($sql);
    }
    //save() end


    //q()

    function q($sql)
    {
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    //q() end







}

//to()
function to($url)
{
    header("location:" . $url);
}
//to() end

//dd()
function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "<pre>";
}
//dd() end

$Total = new DB('total'); //$Total是個物件object
$User = new DB('user');
$News = new DB('news');
$Que = new DB('que');
// -----------------------------------------------------
//瀏覽人次判斷及計算
if (!isset($_SESSION['total'])) {
    $chkDate = $Total->math('count', 'id', ['date' => date('Y-m-d')]); //計算count('id'的日期欄位為今天的資料)有幾筆
    if ($chkDate >= 1) { // >=1 表示今天有拜訪過
        $total = $Total->find(['date' => date("Y-m-d")]);
        $total['total']++;
        $Total->save($total); //此物件執行儲存動作
        $_SESSION['total'] = 1; //拜訪過後給session一個變數，才不會重複計算人數
    } else {
        $Total->save(['date' => date('Y-m-d'), 'total' => 1]); //'total'=>1:表今天尚未拜訪過網站 將其total欄位設定為1 -------再多思考 pm1:40
        $_SESSION['total'] = 1;
    }
}
// ----------------------------------------------------------



?>
