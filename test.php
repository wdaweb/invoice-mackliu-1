<?php

include_once "base.php";

//取得單一資料的自訂函式
function find($table,$id){
    global $pdo;
    $sql="select * from $table where ";
    if(is_array($id)){
        foreach($id as $key => $value){
            $tmp[]=sprintf("`%s`='%s'",$key,$value);
            //$tmp[]="`".$key."`='".$value."'";
        }
        $sql=$sql.implode(' && ',$tmp);
    }else{
        $sql=$sql . " id='$id' ";
    }
    $row=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    //mysqli_fetch_assoc()

    return $row;
}


function all($table,...$arg){
    global $pdo;
    $sql="select * from $table ";

    if(isset($arg[0])){
    
        if(is_array($arg[0])){
            //製作會在 where 後面的句子字串(陣列格式)
                foreach($arg[0] as $key => $value){
                    $tmp[]=sprintf("`%s`='%s'",$key,$value);
                }

                $sql=$sql." where ".implode(' && ',$tmp);
            
        }else{
            //製作非陣列的語句接在$sql後面
                $sql=$sql.$arg[0];       
        }
    }

    if(isset($arg[1])){
        $sql=$sql.$arg[1];
    }
    echo $sql."<br>";
    return $pdo->query($sql)->fetchAll(); 
}

function del($table,$id){
    global $pdo;
    $sql="delete from $table where ";
    if(is_array($id)){
        foreach($id as $key => $value){
            $tmp[]=sprintf("`%s`='%s'",$key,$value);
            
        }
        $sql=$sql.implode(' && ',$tmp);
    }else{
        $sql=$sql . " id='$id' ";
    }
    //echo $sql;
    $row=$pdo->exec($sql);

    return $row;
}



function update($table,$array){
    global $pdo;
    $sql="update $table set ";
    foreach($array as $key => $value){
        if($key!='id'){

            $tmp[]=sprintf("`%s`='%s'",$key,$value);
        }
        //$tmp[]="`".$key."`='".$value."'";
    }
    $sql=$sql.implode(",",$tmp) . " where `id`='{$array['id']}'";
    echo $sql;
   // $pdo->exec($sql);
}

function insert($table,$array){
    global $pdo;
    $sql="insert into $table(`" . implode("`,`",array_keys($array)) . "`) values('".implode("','",$array)."')";


    $pdo->exec($sql);
}

function save($table,$array){

        if(isset($array['id'])){
            //update
            update($table,$array);
        }else{
            //insert
            inset($table,$array);
        }

}
/* $row=find('invoices',22);
echo "<pre>";
print_r($row);
echo "</pre><br>";
//update invoices set `code`='AA',`payment`='1' where `id`='22';
$row['code']='AA';
$row['payment']=1;

update('invoices',$row); */

$row="AAA";
save('invoices',$row);

/* $def=['code'=>'GD'];
echo del('invoices',$def); */

/* echo "<hr>";
print_r(all('invoices'));
echo "<hr>";
print_r(all('invoices',['code'=>"GD",'period'=>6]));
echo "<hr>";
print_r(all('invoices',['code'=>"AB",'period'=>1])," order by date desc");
echo "<hr>";
print_r(all('invoices'," limit 5"));
 */
/* echo "<hr>";
all('invoices');
echo "<hr>";
all('invoices',['code'=>"GD",'period'=>6]);
echo "<hr>";
all('invoices',['code'=>"AB",'period'=>1]," order by date desc");
echo "<hr>";
all('invoices'," limit 5"); */

?>