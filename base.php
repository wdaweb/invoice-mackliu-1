<?php

$dsn="mysql:host=localhost;dbname=invoice;charset=utf8";
$pdo=new PDO($dsn,'root','');

date_default_timezone_set("Asia/Taipei");
session_start();

$awardStr=['頭','二','三','四','五','六'];


function accept($field,$meg='此欄位不得為空'){
    if(empty($_POST[$field])){
        $_SESSION['err'][$field]['empty']=$meg;
    }
}

function length($field,$min,$max,$meg="長度不足"){
    if(strlen($_POST[$field])>$max || strlen($_POST[$field]) < $min){
        $_SESSION['err'][$field]['len']=$meg;
    }
    
}

function email($field,$meg='email格式錯誤'){
    $email=$_POST[$field];
    echo mb_strpos($email,'@');
    if(mb_strpos($email,'@')==false){
        $_SESSION['err'][$field]['email']=$meg;
    }
}

function errFeedBack($field){
    if(!empty($_SESSION['err'][$field])){

        foreach($_SESSION['err'][$field] as $err){
            echo "<div style='font-size:12px;color:red'>";
            echo $err;
            echo "</div>";
        }
    }
}


?>