<?php
include_once "base.php";

$period=ceil(date("m")/2);

//$sql="select * from `invoices` where period='$period' order by date desc";

//$rows=$pdo->query($sql)->fetchAll();
$rows=all('invoices',['period'=>$period],' order by date desc');

?>
<div class='row justify-content-around' style="list-style-type:none;paddin:0">
    <li><a href="">1,2月</a></li>
    <li><a href="">3,4月</a></li>
    <li><a href="">5,6月</a></li>
    <li><a href="">7,8月</a></li>
    <li><a href="">9,10月</a></li>
    <li><a href="">11,12月</a></li>

</div>
<table class="table text-center">
    <tr>
        <td>發票號碼</td>
        <td>消費日期</td>
        <td>消費金額</td>
        <td>操作</td>
    </tr>
    <?php
    foreach($rows as $row){
    ?>
    <tr>
        <td><?=$row['code'].$row['number'];?></td>
        <td><?=$row['date'];?></td>
        <td><?=$row['payment'];?></td>
        <td>
            <button class="btn btn-sm btn-primary">
                <a class="text-light" href="?do=edit_invoice&id=<?=$row['id'];?>">編輯</a>
            </button>
            <button class="btn btn-sm btn-danger">
            <a class="text-light" href="?do=del_invoice&id=<?=$row['id'];?>">刪除</a>
            </button>
            <button class="btn btn-sm btn-success">
            <a class="text-light" href="?do=award&id=<?=$row['id'];?>">對獎</a>
            </button>
        </td>
    </tr>
    <?php
    }
    ?>
</table>