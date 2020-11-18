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
echo "select * from award_numbers where year='$year' && period='$period'";
$awards=$pdo->query("select * from award_numbers where year='$year' && period='$period'")->fetchALL();


echo "<pre>";
print_r($awards);
echo "</pre>";


?>