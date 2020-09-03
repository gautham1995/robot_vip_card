<?php
require "conn.php";
if (!isset($_GET['tid'])) {
	header("location: index.php");
}
?>


<?php

$card = $_GET['tid'];

//echo "<h1>".$tid."</h1>";

$sql = "SELECT * FROM `transaction_history` WHERE vip_card_no = '$card' order by t_stamp desc";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {


echo '
<div class="table-responsive">
    	<table class="table qtable-bordered qtable-sm table-hover">
    <thead class="thead-dark">
      <tr>
        <th>Status</th>
        <th>Card Amt.</th>
        <th>Bill ID</th>
        <th>Bill Amt.</th>
        <th>Date & Time</th>
      </tr>
    </thead>
    <tbody>
';
$st = "";
$bid = "";
$bam = "";
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      //  echo "Bill id: " . $row["bill_id"]. " - Bill Amt.: " . $row["bill_amt"]. " ;; " . $row["vip_amt"]. "<br>";

    	if ($row['side'] == 0) {
    		$st = '<span class="badge badge-pill badge-success">Recharge</span>';
    	}else{
    		$st = '<span class="badge badge-pill badge-warning">Use</span>';
    	}

    	if ($row['bill_id'] == "" || $row['bill_id'] == NULL) {
    		$bid = "";
    	}else{
    		$bid = "#".$row['bill_id'];
    	}

    	if ($row['bill_amt'] == "" || $row['bill_amt'] == NULL) {
    		$bam = "";
    	}else{
    		$bam = "&#8377;&nbsp;".$row['bill_amt'];
    	}


    	echo '
      <tr>
        <td class="text-center">'.$st.'</td>
        <td>&#8377;&nbsp;'.$row['vip_amt'].'</td>
        <td>'.$bid.'</td>
        <td>'.$bam.'</td>
        <td>'.$row['t_stamp'].'</td>
      </tr>
    ';

    }

echo '
</tbody>
  </table>
  </div>
';


} else {
    echo "0 results";
}




?>

