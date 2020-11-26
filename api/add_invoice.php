<?php
//撰寫新增消費發票的程式碼
//將發票的號碼及相關資訊寫入資料庫
include_once "../base.php";
$_SESSION['err']=[];

echo "<pre>";
print_r(array_keys($_POST));
echo "</pre>";
accept('number','發票號碼的欄位必填');
save('invoices',$_POST);
//$sql="insert into invoices (`".implode("`,`",array_keys($_POST))."`) values('".implode("','",$_POST)."')";
//echo $sql;


echo "新增完成";

if(empty($_SESSION['err'])){
    $pdo->exec($sql);
    header("location:../index.php?do=invoice_list");
}else{
    header("location:../index.php");
}

?>