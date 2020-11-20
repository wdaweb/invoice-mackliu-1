<?php

include_once "base.php";



//"select * from invoices where id='9'";
//$row=$pdo->query("select * from invoices where id='9'")->fetch();
//$res=回傳的id為9的發票內容

function find($table,$def){
    global $pdo;

    $sql="select * from $table where $def";
    $row=$pdo->query($sql)->fetch();

    return $row;
}



$row=find('invoices',"id='11'");

echo $row['code'];
echo $row['number'];


$row=find('invoices',"id='16'");

echo $row['code'];
echo $row['number'];


$row=find('invoices',"id='17'");

echo $row['code'];
echo $row['number'];

?>