<?php ob_start (); ?>
<style>
    <?php include './assets/css/style.css' ?>
</style>

<?php
include 'conn.php';

echo "
<table class='tbl-qa' id='table-body'>
    <thead>
        <tr>
            <th class='table-header' width='20%'>MRN / RN</th>
            <th class='table-header' width='20%'>Gigapay Status</th>
            <th class='table-header' width='40%'>Gigapay App Transaction Number</th>
            <th class='table-header' width='20%'>Gigapay ELP Transaction Number</th>
            <th class='table-header' width='20%'>ELP Type</th>
            <th class='table-header' width='20%'>ELP Response Description</th>
            <th class='table-header' width='20%'>Splunk App Transaction Number</th>
            <th class='table-header' width='20%'>Splunk State</th>
            <th class='table-header' width='20%'>Tagging</th>
        </tr>
    </thead>
";

if (isset($_POST['submit'])) {
    $ids = $_POST['searchitem'];

    $counter = 0;
    $exploded_id = explode(",", $ids);
     
    // Excel file name for download 
    $fileName = "variance_investigation_" . date('Y-m-d') . ".xls"; 

    foreach ($exploded_id as $id):
        $counter++;

        $sql = "SELECT
        gigapay_raw_logs.status AS 'Gigapay Status',
        gigapay_raw_logs.app_transaction_number AS 'Gigapay App Transaction Number',
        gigapay_raw_logs.elp_transaction_number AS 'Gigapay ELP Transaction Number',
        raw_elp_logs.type AS 'ELP Type',
        raw_elp_logs.response_description AS 'ELP Response Description',
        splunk.app_transaction_number AS 'Splunk App Transaction Number',
        splunk.state AS 'Splunk State'
        FROM
        gigapay_raw_logs
            LEFT JOIN
        raw_elp_logs ON gigapay_raw_logs.elp_transaction_number = raw_elp_logs.transaction_request_reference_number AND gigapay_raw_logs.elp_transaction_number <> ''
            LEFT JOIN
        splunk ON gigapay_raw_logs.app_transaction_number = splunk.app_transaction_number
        WHERE
        gigapay_raw_logs.app_transaction_number = $id
        OR gigapay_raw_logs.elp_transaction_number = $id";

        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $background = '';
                $giga_status = $row['Gigapay Status'];
                $splunk_state = $row['Splunk State'];
                $giga_statuses = array('FOR_VERIFICATION', 'WALLET_PENDING', 'VERIFICATION_SUCCESSFUL', 'FOR_AUTHENTICATION');
                $splunk_statuses = array('PAYMENT_FAILED', 'AUTH_FAILED', 'PAYMENT_EXPIRED', 'PAYMENT_CANCELLED', 'FOR_AUTHENTICATION', 'VOIDED');

                if ($giga_status == 'ELP_SUCCESSFUL') {
                    $tagging = 'Elp_Successful';
                } else if (in_array(trim($giga_status), $giga_statuses) && trim($splunk_state) == 'PAYMENT_SUCCESS') {
                        $tagging = 'Failed - For Refund';
                } else if (in_array(trim($giga_status), $giga_statuses) && in_array(trim($splunk_state), $splunk_statuses)) {
                        $tagging = 'Not Subject for refund';
                } else if (in_array(trim($giga_status), $giga_statuses) && trim($splunk_state) == '' ) {
                        $tagging = 'Email to NOC';
                        $background = "style='background-color: red !important;'";
                } else {
                    $tagging = '---';
                }
              echo "
                <tbody id='table-body'>
                    <tr class='table-row' $background>
                        <td>".trim($id, "'")."</td>
                        <td>$giga_status</td>
                        <td>".$row['Gigapay App Transaction Number']."</td>
                        <td>".$row['Gigapay ELP Transaction Number']."</td>
                        <td>".$row['ELP Type']."</td>
                        <td>".$row['ELP Response Description']."</td>
                        <td>".$row['Splunk App Transaction Number']."</td>
                        <td>$splunk_state</td>
                        <td>$tagging</td>
                    </tr>
                </tbody>
              ";
            }
        } else {
            echo "
                <tbody id='table-body'>
                    <tr class='table-row'>
                        <td>".trim($id, "'")."</td>
                        <td colspan=7> Not Found </td>
                        <td>For escalation to L3</td>
                    </tr>
                </tbody>
              ";
          }
    endforeach;
}

echo "
</table>
<br /><br />
$counter Rows returned!
";

// Headers for download 
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$fileName\"");

// Render excel data 
//echo $excelData;

ob_end_flush ();
exit;
?>