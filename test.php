<?php

include_once "base.php";



//"select * from invoices where id='9'";
//$row=$pdo->query("select * from invoices where id='9'")->fetch();
//$res=回傳的id為9的發票內容

function find($table,$id){
    global $pdo;
    
    if(is_numeric($id)){
        $sql="select * from $table where id='$id'";
    }else{
        $sql="select * from $table where $id";
    }

    $row=$pdo->query($sql)->fetch();

    return $row;
}

$row=find('invoices',11);
echo $row['code'].$row['number']."<br>";

$row=find('invoices',"code='AB' && number='84232176'");
echo $row['code'].$row['number']."<br>";

$row=find('invoices',17);
echo $row['code'].$row['number']."<br>";


?>