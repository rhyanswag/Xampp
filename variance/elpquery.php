<title>ELP Import Result</title>
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

            if (count($numcols) != 17) {
                echo "
                    <nav aria-label='breadcrumb'>
                        <ol class='breadcrumb'>
                            <li class='breadcrumb-item'><a href='index.php'>Home</a></li>
                            <li class='breadcrumb-item' aria-current='page'><a href='importelp.php'>Import ELP Raw Logs</a></li>
                            <li class='breadcrumb-item active' aria-current='page'>ELP import result</li>
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
                $type = $getData[1];
                $number = $getData[2];
                $corporate_id = $getData[3];
                $branch_id = $getData[4];
                $request_reference_number = $getData[5];
                $plan_code = $getData[6];
                $amount = $getData[7];
                $retailer_deduct = $getData[8];
                $retailer_new_balance = $getData[9];
                $response_code = $getData[10];
                $response_description = $getData[11];
                $transaction_request_reference_number = $getData[12];
                $transaction_timestamp = $getData[13];
                $body = $getData[14];
                $created_at = $getData[15];
                $updated_at = $getData[16];

                mysqli_query($conn, "INSERT INTO raw_elp_logs (id, type, number, corporate_id, branch_id, request_reference_number, plan_code, amount, retailer_deduct, retailer_new_balance, response_code, response_description, transaction_request_reference_number, transaction_timestamp, body, created_at, updated_at) VALUES ('" . $id . "', '" . $type . "', '" . $number . "', '" . $corporate_id . "', '" . $branch_id . "', '" . $request_reference_number . "', '" . $plan_code . "', '" . $amount . "', '" . $retailer_deduct . "', '" . $retailer_new_balance . "', '" . $response_code . "', '" . $response_description . "', '" . $transaction_request_reference_number . "', '" . $transaction_timestamp . "', '" . $body . "', '" . $created_at . "', '" . $updated_at ."' )");

                $counter++;
            }
 
            // Close opened CSV file
            fclose($csvFile);

            echo "
                <br />
                <div class='container'>
            ";

            echo "
                <nav aria-label='breadcrumb'>
                    <ol class='breadcrumb'>
                        <li class='breadcrumb-item'><a href='index.php'>Home</a></li>
                        <li class='breadcrumb-item' aria-current='page'><a href='importelp.php'>Import ELP Raw Logs</a></li>
                        <li class='breadcrumb-item active' aria-current='page'>ELP import result</li>
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
}