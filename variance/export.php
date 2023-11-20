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
        </tr>
    </thead>
";

if (isset($_POST['submit'])) {
    $ids = $_POST['searchitem'];

    $counter = 0;
    //$td_class = ($counter%2)? 'odd': 'even';
    $exploded_id = explode(",", $ids);

    /**
     * initiate excel export
     */
    function filterData(&$str){
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }
     
    // Excel file name for download 
    $fileName = "variance_investigation_" . date('Y-m-d') . ".xls"; 
     
    // Column names 
    $fields = array('MRN / RN', 'Gigapay Status', 'Gigapay App Transaction Number', 'Gigapay ELP Transaction Number', 'ELP Type', 'ELP Response Desctiption', 'Splunk App Transaction Number', 'Splunk State'); 
     
    // Display column names as first row 
    $excelData = implode("\t", array_values($fields)) . "\n";
    //end excel initiation

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

                //write excel data
                $lineData = array(trim($id, "'"), $row['Gigapay Status'], $row['Gigapay App Transaction Number'], $row['Gigapay ELP Transaction Number'], $row['ELP Type'], $row['ELP Response Description'], $row['Splunk App Transaction Number'], $row['Splunk State']);
                array_walk($lineData, 'filterData');
                $excelData .= implode("\t", array_values($lineData)) . "\n";

              echo "
                <tbody id='table-body'>
                    <tr class='table-row'>
                        <td>".trim($id, "'")."</td>
                        <td>".$row['Gigapay Status']."</td>
                        <td>".$row['Gigapay App Transaction Number']."</td>
                        <td>".$row['Gigapay ELP Transaction Number']."</td>
                        <td>".$row['ELP Type']."</td>
                        <td>".$row['ELP Response Description']."</td>
                        <td>".$row['Splunk App Transaction Number']."</td>
                        <td>".$row['Splunk State']."</td>
                    </tr>
                </tbody>
              ";
            }
        } else {
            //write excel data
            $lineData = array(trim($id, "'"), 'Not Found', '', '', '', '', '', '');
            array_walk($lineData, 'filterData');
            $excelData .= implode("\t", array_values($lineData)) . "\n";

            echo "
                <tbody id='table-body'>
                    <tr class='table-row'>
                        <td>".trim($id, "'")."</td>
                        <td colspan=7> Not Found </td>
                    </tr>
                </tbody>
              ";
          }
    endforeach;
}

// echo "
// </table>
// <br /><br />
// $counter Rows returned!
// <br />
// <a href='/variance'>Back to Query</a>
// ";

// Headers for download 
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$fileName\"");

// Render excel data 
//echo $excelData;

ob_end_flush ();
exit;
?>