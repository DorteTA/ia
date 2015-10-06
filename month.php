<?php 

include_once("inc/Connstring.php");
include_once("inc/HTMLTemplate.php");

$months = 12;
$month_1 = 1;
$month_jan ="Januari";
$month_2 = 2;
$month_3 = 3;
$month_4 = 4;
$month_5 = 5;
$month_6 = 6;
$month_jun ="Juni";
 
if($months == 1) {
   echo "The month is: $month_1 <br>";
   $months++;
 
}


  
if($month_1 == 1 && $months >= 12) {
   echo "$month_jan <br>";
   $month_1--;
}
   if($month_6 == 6) {
   echo "Månad: $month_jun <br>";
   $month_6--;
   }

 
$months = 1;

do {
    echo "The number of the month is: $months <br>";
    $months++;
} while ($months<=12);

?>
