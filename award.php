<?php
include_once "base.php";

$inv_id=$_GET['id'];
//echo "select * from invoice where id='$inv_id'";
$invoice=$pdo->query("select * from invoices where id='$inv_id'")->fetch();
$number=$invoice['number'];
/* echo "<pre>";
print_r($invoice);
echo "</pre>"; */

//找出獎號
/**
 * 1.確認期數->目前的發票的日期做分析
 * 2.得到期數的資料後->撈出該期的開獎獎號
 * 
 */
$date=$invoice['date'];
//explode('-',$date)取得日期資料的陣列,陣列的第二個元素就是月
//月份就可以推算期數,有了期數及年份就可以找到開獎的號碼
// $array=explode('-',$date)
// $month=$array[1]
// $period=ceil($month/2)
$year=explode('-',$date)[0];
$period=ceil(explode('-',$date)[1]/2);
//echo "select * from award_numbers where year='$year' && period='$period'";
$awards=$pdo->query("select * from award_numbers where year='$year' && period='$period'")->fetchALL();

/* 
echo "<pre>";
print_r($awards);
echo "</pre>"; */

foreach($awards as $award){
    switch($award['type']){
        case 1:
            //特別號=我的發票號碼
            
            
            if($award['number']==$number){
                echo "<br>號碼=".$number."<br>";
                echo "<br>中了特別獎<br>";
            }else{
                echo "<br>特別獎沒中<br>";
            }
        break;
        case 2:
            
            if($award['number']==$number){
                echo "<br>號碼=".$number."<br>";
                echo "中了特獎<br>";
            }else{
                echo "特獎沒中<br>";
            }

        break;
        case 3:
            for($i=5;$i>=0;$i--){
                $target=mb_substr($award['number'],$i,(8-$i),'utf8');
                $mynumber=mb_substr($number,$i,(8-$i),'utf8');

                if($target==$mynumber){
                    echo "<br>號碼=".$number."<br>";
                    echo "中了{$awardStr[$i]}獎<br>";
                }else{
                    break;
                    //continue
                }
            }
        break;
        case 4:
            if($award['number']==mb_substr($number,5,3,'utf8')){
                echo "<br>號碼=".$number."<br>";
                echo "中了增開六獎";
            }
        break;
    }
}


?>