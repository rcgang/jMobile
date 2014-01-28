<?php
function getInterestAmount($amount,$days, $interest) 

{	

	$a = (($amount/30)*$days*$interest)/100;

	return ceil($a);

}

function getTotalAmount($amount,$days, $interest) 

{	

	$a = $amount+(($amount/30)*$days*$interest)/100;

	return ceil($a);

}
if( empty($_POST['from']) || empty($_POST['to']) || empty($_POST['amount']) || empty($_POST['interest'])) {
	echo "All fields are required DARLING";
	exit;
}
$date = explode('-', $_POST['from']);
$fromDate = $date['2'].'-'.$date['1'].'-'.$date['0']; 

$todate = explode('-', $_POST['to']);
$tooDate = $todate['2'].'-'.$todate['1'].'-'.$todate['0']; 


$datetime1 = new DateTime($fromDate);
$datetime2 = new DateTime($tooDate);

$difference = $datetime1->diff($datetime2);
$amount = $_POST['amount'];
$totalDays = ($difference->m*30)+$difference->d;  
?>
<?php for ($i=1; $i<= $difference->y ; $i++ ) { 
		getInterestAmount($amount, 360, $_POST['interest']);
		$t = getTotalAmount($amount, 360, $_POST['interest']);
		$amount = $t; 
 } 

	getInterestAmount($amount, $totalDays, $_POST['interest']);
	$grand = getTotalAmount($amount, $totalDays, $_POST['interest']);
?>
Principle Amount = <?php echo $_POST['amount'];?> Rs<br>
Interest Amount = <?php echo $grand-$_POST['amount'];?> Rs<br>
Grand Total = <?php echo $grand;?> Rs