<?php
include_once "../base.php";

$sql="update 
        invoices 
      set 
        `code`='{$_POST['code']}',
        `number`='{$_POST['number']}',
        `date`='{$_POST['date']}',
        `payment`='{$_POST['payment']}' 
      where 
        `id`='{$_POST['id']}'";

$pdo->exec($sql);

header("location:../index.php?do=invoice_list");
?>