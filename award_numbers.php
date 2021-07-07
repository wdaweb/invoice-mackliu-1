<?php
include_once "base.php";

if(isset($_GET['pd'])){
    $year=explode("-",$_GET['pd'])[0];
    $period=explode("-",$_GET['pd'])[1];
}else{
    $get_news=$pdo->query("SELECT * FROM `award_numbers` order by year desc ,period desc limit 1")->fetch();
    $year=$get_news['year'];
    $period=$get_news['period'];
    
}
/* echo "year=".$year;
echo "<br>";
echo "period=".$period; */
$awards=$pdo->query("select * from award_numbers where year='$year' && period='$period'")->fetchAll();
$special="";
$grand="";
$first=[];
$six=[];

foreach($awards as $aw){
    switch($aw['type']){
        case 1:
            $special=$aw['number'];
        break;
        case 2:
            $grand=$aw['number'];
        break;
        case 3:
            $first[]=$aw['number'];
        break;
        case 4:
            $six[]=$aw['number'];
        break;
    }
}

?>
<div class='row justify-content-around' style="list-style-type:none;paddin:0">
    <li><a href="?do=award_numbers&pd=2020-1">1,2月</a></li>
    <li><a href="?do=award_numbers&pd=2020-2">3,4月</a></li>
    <li><a href="?do=award_numbers&pd=2020-3">5,6月</a></li>
    <li><a href="?do=award_numbers&pd=2020-4">7,8月</a></li>
    <li><a href="?do=award_numbers&pd=2020-5">9,10月</a></li>
    <li><a href="?do=award_numbers&pd=2020-6 ">11,12月</a></li>

</div>
<table class="table table-bordered table-sm" summary="統一發票中獎號碼單"> 
   <tbody>
    <tr> 
     <th id="months">年月份</th> 
     <td headers="months" class="title">
        <?=$year;?>年
        <?php
            $month=[
                1=>"01 ~ 02",
                2=>"03 ~ 04",
                3=>"05 ~ 06",
                4=>"07 ~ 08",
                5=>"09 ~ 10",
                6=>"11 ~ 12"
            ];
            echo $month[$period];
        ?>月 
    </td> 
    </tr> 
    <tr> 
     <th id="specialPrize" rowspan="2">特別獎</th> 
     <td headers="specialPrize" class="number"> 
       <?=$special;?>
    </td> 
    </tr> 
    <tr> 
     <td headers="specialPrize"> 同期統一發票收執聯8位數號碼與特別獎號碼相同者獎金1,000萬元 </td> 
    </tr> 
    <tr> 
     <th id="grandPrize" rowspan="2">特獎</th> 
     <td headers="grandPrize" class="number"> 
        <?=$grand;?>
      </td> 
    </tr> 
    <tr> 
     <td headers="grandPrize"> 同期統一發票收執聯8位數號碼與特獎號碼相同者獎金200萬元 </td> 
    </tr> 
    <tr> 
     <th id="firstPrize" rowspan="2">頭獎</th> 
     <td headers="firstPrize" class="number">
        <?php
            foreach($first as $f){
                echo $f."<br>";
            }

        ?>
      </td> 
    </tr> 
    <tr> 
     <td headers="firstPrize"> 同期統一發票收執聯8位數號碼與頭獎號碼相同者獎金20萬元 </td> 
    </tr> 
    <tr hidden> 
     <th id="twoPrize">二獎</th> 
     <td headers="twoPrize"> 同期統一發票收執聯末7 位數號碼與頭獎中獎號碼末7 位相同者各得獎金4萬元 </td> 
    </tr> 
    <tr hidden> 
     <th id="threePrize">三獎</th> 
     <td headers="threeAwards"> 同期統一發票收執聯末6 位數號碼與頭獎中獎號碼末6 位相同者各得獎金1萬元 </td> 
    </tr> 
    <tr hidden> 
     <th id="fourPrize">四獎</th> 
     <td headers="fourPrizes"> 同期統一發票收執聯末5 位數號碼與頭獎中獎號碼末5 位相同者各得獎金4千元 </td> 
    </tr> 
    <tr hidden> 
     <th id="fivePrize">五獎</th> 
     <td headers="fivePrize"> 同期統一發票收執聯末4 位數號碼與頭獎中獎號碼末4 位相同者各得獎金1千元 </td> 
    </tr> 
    <tr hidden> 
     <th id="sixPrize">六獎</th> 
     <td headers="sixPrize"> 同期統一發票收執聯末3 位數號碼與 頭獎中獎號碼末3 位相同者各得獎金2百元 </td> 
    </tr> 
    <tr> 
     <th id="addSixPrize">增開六獎</th> 
     <td headers="addSixPrize" class="number"> 
        <?php
            foreach($six as $s){
                echo $s."<br>";
            }
        ?>
    </td> 
    </tr>  
   </tbody>
</table>
<button class="btn btn-primary mx-auto">
        <a href="?do=all_awards&year=<?=$year;?>&period=<?=$period;?>" class="text-light">對獎</a>
</button>