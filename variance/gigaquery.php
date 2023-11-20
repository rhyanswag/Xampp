<title>Gigapay Import Result</title>
<style>
<?php include './assets/css/bootstrap.min.css'; ?>
</style>

<?php
// include mysql database configuration file
include_once 'conn.php';
 
if (isset($_POST['submit']))
{
 
    // Allowed mime types
    $fileMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );
 
    // Validate whether selected file is a CSV file
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes))
    {
        $file = $_FILES['file']['name'];
 
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
 
            // Skip the first line
            //fgetcsv($csvFile);

            echo "
                <br />
                <div class='container'>
            ";

            // Skip the first line
            $numcols = fgetcsv($csvFile);

            if (count($numcols) != 43) {
                echo "
                    <nav aria-label='breadcrumb'>
                        <ol class='breadcrumb'>
                            <li class='breadcrumb-item'><a href='index.php'>Home</a></li>
                            <li class='breadcrumb-item' aria-current='page'><a href='importgiga.php'>Import Gigapay Raw Logs</a></li>
                            <li class='breadcrumb-item active' aria-current='page'>Gigapay import result</li>
                        </ol>
                    </nav>
                ";

                echo "
                    <div class='alert alert-danger' role='alert'>
                        File not match!
                    </div>
                ";

                die;
            }
 
            // Parse data from CSV file line by line
             // Parse data from CSV file line by line
            $counter = 0;
            while (($getData = fgetcsv($csvFile, 100000000, ",")) !== FALSE)
            {
                // Get row data
                $id = $getData[0];
                $status = $getData[1];
                $transaction_digest = $getData[2];
                $number = $getData[3];
                $main_number = $getData[4];
                $brand = $getData[5];
                $transaction_date = $getData[6];
                $transaction_type = $getData[7];
                $payment_method = $getData[8];
                $currency = $getData[9];
                $amount = $getData[10];
                $keyword = $getData[11];
                $action = $getData[12];
                $payment_reference_number = $getData[13];
                $app_transaction_number = $getData[14];
                $comment = $getData[15];
                $is_payment_status_updated = $getData[16];
                $authentication_status_origin = $getData[17];
                $wallet_amount = $getData[18];
                $wallet_fees = $getData[19];
                $wallet_status = $getData[20];
                $wallet_request_reference_no = $getData[21];
                $wallet_merchant_value = $getData[22];
                $wallet_payment_token_id = $getData[23];
                $paymaya_checkout_id = $getData[24];
                $paymaya_void_id = $getData[25];
                $paymaya_void_reason = $getData[26];
                $last_four = $getData[27];
                $first_six = $getData[28];
                $card_type = $getData[29];
                $elp_transaction_number = $getData[30];
                $elp_corporation_id = $getData[31];
                $elp_branch_id = $getData[32];
                $elp_request_reference_number = $getData[33];
                $elp_plan_code = $getData[34];
                $elp_amount = $getData[35];
                $elp_retailer_deduct = $getData[36];
                $elp_retailer_new_balance = $getData[37];
                $elp_response_code = $getData[38];
                $elp_response_description = $getData[39];
                $elp_transaction_timestamp = $getData[40];
                $created_at = $getData[41];
                $updated_at = $getData[42];

                mysqli_query($conn, "INSERT INTO gigapay_raw_logs (id, status, transaction_digest, number, main_number, brand, transaction_date, transaction_type, payment_method, currency, amount, keyword, action, payment_reference_number, app_transaction_number, comment, is_payment_status_updated, authentication_status_origin, wallet_amount, wallet_fees, wallet_status, wallet_request_reference_no, wallet_merchant_value, wallet_payment_token_id, paymaya_checkout_id, paymaya_void_id, paymaya_void_reason, last_four, first_six, card_type, elp_transaction_number, elp_corporation_id, elp_branch_id, elp_request_reference_number, elp_plan_code, elp_amount, elp_retailer_deduct, elp_retailer_new_balance, elp_response_code, elp_response_description, elp_transaction_timestamp, created_at, updated_at) VALUES ('" . $id . "', '" . $status . "', '" . $transaction_digest . "', '" . $number . "', '" . $main_number . "', '" . $brand . "', '" . $transaction_date . "', '" . $transaction_type . "', '" . $payment_method . "', '" . $currency . "', '" . $amount . "', '" . $keyword . "', '" . $action . "', '" . $payment_reference_number . "', '" . $app_transaction_number . "', '" . $comment . "', '" . $is_payment_status_updated . "', '" . $authentication_status_origin . "', '" . $wallet_amount . "', '" . $wallet_fees . "', '" . $wallet_status . "', '" . $wallet_request_reference_no . "', '" . $wallet_merchant_value . "', '" . $wallet_payment_token_id . "', '" . $paymaya_checkout_id . "', '" . $paymaya_void_id . "', '" . $paymaya_void_reason . "', '" . $last_four . "', '" . $first_six . "', '" . $card_type . "', '" . $elp_transaction_number . "', '" . $elp_corporation_id . "', '" . $elp_branch_id . "', '" . $elp_request_reference_number . "', '" . $elp_plan_code . "', '" . $elp_amount . "', '" . $elp_retailer_deduct . "', '" . $elp_retailer_new_balance . "', '" . $elp_response_code . "', '" . $elp_response_description . "', '" . $elp_transaction_timestamp . "', '" . $created_at . "', '" . $updated_at ."' )");

                $counter++;
                
            }
 
            // Close opened CSV file
            fclose($csvFile);

            echo "
                <nav aria-label='breadcrumb'>
                    <ol class='breadcrumb'>
                        <li class='breadcrumb-item'><a href='index.php'>Home</a></li>
                        <li class='breadcrumb-item' aria-current='page'><a href='importgiga.php'>Import Gigapay Raw Logs</a></li>
                        <li class='breadcrumb-item active' aria-current='page'>Gigapay import result</li>
                    </ol>
                </nav>
            ";

            echo "
                <div class='alert alert-success' role='alert'>
                    $file successfully imported. $counter rows inserted.
                </div>
            ";
         
    }
    else
    {
        echo "
            <div class='alert alert-danger' role='alert'>
                $file invalid file.
            </div>
        ";
    }
    echo "<div />";
}