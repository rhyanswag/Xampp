<?php 
date_default_timezone_set('Asia/Manila');
//export.php  
$fileName = date("Y-m-d"). '_RAW_ELP_LOGS.csv';
$connect = mysqli_connect("localhost", "root", "", "elplogs");  
header('Content-Type: text/csv; charset=utf-8');  
header("Content-Disposition: attachment; filename=\"$fileName\"");

$output = fopen("php://output", "w");  
//$output = fopen($fileName, "w");  
fputcsv($output, array('id','type','number','corporate_id','branch_id','request_reference_number','plan_code','amount','retailer_deduct','retailer_new_balance','response_code','response_description','transaction_request_reference_number','transaction_timestamp','body','created_at','updated_at'));  
$query = "SELECT * FROM elp_logs";  
$result = mysqli_query($connect, $query);  
while($row = mysqli_fetch_assoc($result))  
{  
    fputcsv($output, $row);  
}  
fclose($output);  

?>